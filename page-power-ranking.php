<?php get_header(); ?>

<?php 
function get_power_ranking_posts() {
	global $wpdb, $paged, $max_num_pages;

	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$post_per_page = intval( get_query_var('posts_per_page') );
	$offset = ( $paged - 1 ) * $post_per_page;

	$sql = " 
		SELECT 
			SQL_CALC_FOUND_ROWS posts.*, 
			(posts.menu_order * mt.meta_value) / POW( TIMESTAMPDIFF( MINUTE, posts.post_date, NOW() ), 0.5 ) AS power 
		FROM 
			{$wpdb->posts} AS posts 
		LEFT JOIN 
			{$wpdb->postmeta} AS mt ON (posts.ID = mt.post_id) 
		WHERE 
			meta_key = 'power_ranking_text' 
		ORDER 
			BY power DESC
		LIMIT 
			" . $offset . ", " . $post_per_page 
	;

	$sql_result = $wpdb->get_results( $sql, OBJECT );

	$sql_posts_total = $wpdb->get_var( "SELECT FOUND_ROWS();" );
	$max_num_pages = ceil( $sql_posts_total / $post_per_page );

	return $sql_result;
}

$power_ranking_posts = get_power_ranking_posts();
?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="eightcol first clearfix" role="main">

							<h1><?php the_title(); ?></h1>

							<?php if ($power_ranking_posts): ?>
								<?php global $post; ?>
								<?php foreach ($power_ranking_posts as $post): ?>

									<?php setup_postdata($post); ?>

									<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix articles-list' ); ?> role="article">


										<header class="article-header">
											<h2><?php the_title(); ?> <span class='label label-success'><?php echo ceil($post->power); ?></span></h2>

											<p class="byline vcard"><?php
												printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'bonestheme' )), bones_get_the_author_posts_link());
											?></p>

										</header>

										<section class="entry-content clearfix">

											<?php the_post_thumbnail( 'related-thumb' ); ?>
											
											<div class="excerpt">
												<?php the_excerpt(); ?>
											</div>

											<div class="social-share clearfix">
												<?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
												<div class="clearfix"></div>
											</div>

										</section>

										<footer class="article-footer">

										</footer>

									</article>

							<?php endforeach; else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

							<div class="pagination">
								<?php 
								global $wp_query;

								$big = 999999999;
								
								echo paginate_links(array(
									'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
									'format' => '?paged=%#%',
									'current' => max(1, get_query_var('paged')),
									'prev_text' => __('«'),
									'next_text' => __('»'),
									'total' => $max_num_pages
								)); ?>
							</div>

						</div>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--||||||||||||||||||||||||||||||GEO-LOCATION|||||||||||||||||||||-->
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<div class="concertsb2">
    <?php
        function get_client_ip_env() {  
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
                $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }
  
        $geoplugin  = maybe_unserialize( wp_remote_fopen('http://www.geoplugin.net/php.gp?ip=' . get_client_ip_env()) );
        $user_lat   = $geoplugin['geoplugin_latitude'];
        $user_long  = $geoplugin['geoplugin_longitude'];
    ?>
    <h3></h3>
    <div class="zumic-a clearfix">
        <a href="https://www.superstartickets.com/Concerts" target="_blank" style="width:310px;border:none;padding-left:12px;">
            <img src="http://zumic.com/wp-content/uploads/2015/02/logo-transparent.png" >   
        </a>
        <div class="sidebar-geotitle">
            <p>shows near you</p>
            <hr style="margin-right:15px;margin-left:25px;height:.2%;">
        </div>
    </div>                  
    <h3 class="tagstitle" style="font-size:13px;"></h3> 
            <?php
                //$timecutoff = date("Y-m-d");
                $args = array(
                    'post_type' =>  'venues',
                    // 'orderby' => 'meta_value',
                    // 'meta_key' => 'event_date',
                    // 'meta_compare' => '>=',
                    // 'meta_value' => $timecutoff,
                     'posts_per_page' => -1, 
                     //'order' => 'ASC',
                    // 'ignore_sticky_posts' => true
                         );
                $my_query = new WP_Query($args);
                if ($my_query->have_posts()) : while ($my_query->have_posts()) :
                $my_query->the_post();
                    //$eventdate = get_post_meta($post->ID, "eventdate", true);
                    $event_lat  = get_field( 'location_latitude' ); 
                    $event_long = get_field( 'location_longitude' ); 
                    $earth_radius = 3960.00; # in miles
                    $lat_1 = $event_lat;
                    $lon_1 = $event_long;
                    $lat_2 = $user_lat;
                    $lon_2 = $user_long;
                    $delta_lat = $lat_2 - $lat_1 ;
                    $delta_lon = $lon_2 - $lon_1 ;
                    $hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2); 
                    $max_distance = 100; 
            	?>
 

    <?php if ($hav_distance <= $max_distance) { ?>




    <style>
        .sidebar-geotitle2{display: none;}
        .hideclass{display: none;}
        .sidebar-geotitle{display: inline!important;}
    </style>
    <?php the_title(); ?>
    <div class="hov">   
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
            <table class="hoverTable">
              <tr>
                <td style="min-width:100px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:black;letter-spacing:.5px;">
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "M j";
                                $unixtimestamp = strtotime(get_field('event_date'));
                                //echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                        <br>
                            <?php //echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
                        <strong>
                            <?php // THE TITLE //
                                $titlesub = get_the_title();
                                //echo substr( $titlesub, 0, -15); 
                            ?>
                        </strong>
                    </div> 
                </td>
                  </tr>
            </table>    
            <br>
        </a>
        </div>  
        
    <?php } ?>

    <?php endwhile; 
    wp_reset_postdata(); ?>
    <?php else: ?>
    <style>
        .sidebar-geotitle{display: none;}
        .hideclass{display: none;}
    </style>
    <div class="sidebar-geotitle2">
        <p>presents top tours</p>
        <hr style="margin-right:15px;margin-left:25px;height:.2%;">
    </div>
        <div>
            <?php
                $args = array(
                    'post_type' => array( 'post', 'music-videos' ), 
                    'post_status' => 'publish', 
                    'posts_per_page' => 2, 
                    'orderby'  => 'menu_order',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => array( 'concert-announcements' ),
                            'operator' => 'IN'
                        )
                    ),  
                );
                $the_query = new WP_Query($args);
                while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
                <div class="item link" data-href="<?php the_permalink(); ?>">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                         <?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
                    </a>
                    <div class="single-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><h3><?php the_title(); ?></h3></a></div>
                </div>                     
                <?php 
                endwhile;
                wp_reset_postdata();
                ?>
        </div>
        <br>        
    <?php  endif; ?>
    <?php  wp_reset_postdata(); ?>
        </tr>
    <br>
    <?php if ($hav_distance >= $max_distance) { ?>
    <style>
        .sidebar-geotitle{display: none;}
    </style>
    <div class="hideclass">
        <div class="sidebar-geotitle2">
            <p>presents top tours</p>
            <hr style="margin-right:15px;margin-left:25px;height:.2%;">
        </div>
                <?php
                    $args = array(
                        'post_type' => array( 'post', 'music-videos' ), 
                        'post_status' => 'publish', 
                        'posts_per_page' => 2, 
                        'orderby'  => 'menu_order',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => array( 'concert-announcements' ),
                                'operator' => 'IN'
                            )
                        ),  
                    );
                    $the_query = new WP_Query($args);
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                ?>  
                <div class="item link" data-href="<?php the_permalink(); ?>">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                         <?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
                    </a>
                    <div class="single-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><h3><?php the_title(); ?></h3></a></div>
                </div>                     
    <?php  endwhile;
    wp_reset_postdata(); ?>
            </div>  
    <?php } ?>
</div>


<br>
<!--||||||||||||||||END||||||||||||GEO-LOCATION||||||||||||||||||||-->

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
