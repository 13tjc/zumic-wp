<?php 
$has_right_col = get_field( "media_column" ) ? true : false;
$grid_l = $has_right_col ? 'grid-6' : 'grid-8';
?>
<link rel="stylesheet" href="http://zumic.com/wp-content/themes/zumic-backbone/library/css/style.css">
<style>

	div.widget.clicky-popular-posts-widget .single-title {width: 130%!important;margin-right: -195px!important;}
	div.concertsb6 h3 {line-height: 25px!important;}
	.new-ad {padding-left: 20px!important;}
	.entry-content .addthis_toolbox {display: none!important;}
	.geo-date {width: 85px!important;}
	.authorstars {float: right;margin-top: -74px;}
	div.author-post-rating {display: block;margin: 1em 0;margin-left: 0!important;margin-top: 0!important; }
	div.block-related-latest-news.grid-4.last {width: 340px;}
@media only screen and (max-device-width: 480px) { 
	.kk-star-ratings.lft {float: left!important;margin-top: 20px!important;} 
	.authorstars {float: right;margin-top: -21px;margin-bottom: 14px;margin-left: -262px;width: 100%;}
	.authorstars p {float: left;margin-top: 21px;padding-right: 10px;}
}
@media only screen and (min-width: 768px) {  
	div.widget.clicky-popular-posts-widget .single-title {margin-right: -285px!important;}
}
@media only screen and (min-width: 1030px) {  
	div.widget.clicky-popular-posts-widget .single-title {margin-right: -16px!important;}
}
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>   
<script type="text/javascript">
$( document ).ready(function() {
        $(".collapseomatic_content").show();     
    });
</script>
<?php get_header(); ?>
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
	$geoiix     = $geoplugin['geoplugin_regionName'];
	$user_lat   = $geoplugin['geoplugin_latitude'];
	$user_long  = $geoplugin['geoplugin_longitude'];
?>
<div id="content">
<div id="inner-content" class="wrap clearfix">
<div id="main" class="first clearfix" role="main">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
	<section class="entry-content clearfix <?php echo $grid_l; ?> scrollable-col">
	
		<div class="body-border">
		<header class="article-header">
			<h1 class="page-title music-videos-title entry-title"><?php the_title(); ?></h1>
			<?php bones_page_credits(); ?>
			<div class="release-date">
			 <?php if( get_field("release_date") ){  ?>
				    <?php 
				    	echo "Released: "; 
						$date = DateTime::createFromFormat('Ymd', get_field('release_date'));
						echo $date->format('F jS, Y');
				    ?>
				    
				    <?php } else { ?>
				           
				    <?php echo " "; ?>
				     
			<?php } ?>
		</div>
<div class="all-ratings">
<div class="editor-rating">
<?php if(get_field('star_rating') == "0.0"){ ?>
    <?php echo " "; ?>
    <?php } ?>
	   <?php if(get_field('star_rating') == "1.0"){ ?>
	    <p>ZUMIC RATING: </p>
	    <img src="http://zumic.com/wp-content/uploads/2015/01/1rate1.png" >
	    <?php } ?>
	    <?php if(get_field('star_rating') == "1.5"){ ?>
	    <p>ZUMIC RATING: </p>
	    <img src="http://zumic.com/wp-content/uploads/2015/01/1half1.png" >
	    <?php } ?>
	    <?php if(get_field('star_rating') == "2.0"){ ?>
	    <p>ZUMIC RATING: </p>
	    <img src="http://zumic.com/wp-content/uploads/2015/01/2rate1.png" >
	    <?php } ?>
	    <?php if(get_field('star_rating') == "2.5"){ ?>
	    <p>ZUMIC RATING: </p>
	    <img src="http://zumic.com/wp-content/uploads/2015/01/2half1.png" >
	    <?php } ?>
	    <?php if(get_field('star_rating') == "3.0"){ ?>
	    <p>ZUMIC RATING: </p>
	    <img src="http://zumic.com/wp-content/uploads/2015/01/3rate1.png" >
	    <?php } ?>
	    <?php if(get_field('star_rating') == "3.5"){ ?>
	    <p>ZUMIC RATING: </p>
	    <img src="http://zumic.com/wp-content/uploads/2015/01/3half1.png" >
	    <?php } ?>
	    <?php if(get_field('star_rating') == "4.0"){ ?>
	    <p>ZUMIC RATING: </p>
	    <img src="http://zumic.com/wp-content/uploads/2015/01/4rate1.png" >
	    <?php } ?>
	    <?php if(get_field('star_rating') == "4.5"){ ?>
	    <p>ZUMIC RATING: </p>
	    <img src="http://zumic.com/wp-content/uploads/2015/01/4half1.png" >
	    <?php } ?>
	    <?php if(get_field('star_rating') == "5.0"){ ?>
	    <p>ZUMIC RATING: </p>
	    <img src="http://zumic.com/wp-content/uploads/2015/01/5rate1.png" >
	    <?php } ?>
					</div>
			
</div>
                <br>
		</header>
		<div class="bodhid">
			<?php the_content(); ?>
		</div>
	<?php wp_pagenavi( array( 'type' => 'multipart' ) ); ?>
	 
		<div class="tags-wrapper">
			<p class="tags"><?php echo get_the_term_list( get_the_ID(), 'media-type', '<span class="tags-title">' . __( 'Media Type:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
			<p class="tags"><?php echo get_the_term_list( get_the_ID(), 'music-genres', '<span class="tags-title">' . __( 'Genres:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
			<p class="tags"><?php echo get_the_term_list( get_the_ID(), 'local-music', '<span class="tags-title">' . __( 'Locations:', 'bonestheme' ) . '</span> ', ', ' ) ?></p>
			<p class="tags">
				<span class="tags-title">Tags:</span>
				<?php
					$tags = wp_get_post_tags( $post->ID, ['fields' => 'all'] );
					$tags_output = [];
					foreach ($tags as $key => $value) {
						$args = [
							'name' => $value->slug,
							'post_type' => 'artists',
							'post_status' => 'publish',
							'orderby' => 'menu_order',
							'numberposts' => 1
						];
						$artist_page = get_posts($args);
						if($artist_page) {
							$tags_output[] = "<a href='/artists/" . $value->slug ."'>" . $value->name . "</a>";
						} else {
							$tags_output[] = "<a href='/tag/" . $value->slug ."'>" . $value->name . "</a>";
						}
					}
					if($tags_output) {
							print implode(', ', $tags_output);
					}
				?>
			</p>
		</div>
		<br>
		<div>
		<div style="float:left;padding-right:5px;" class="fb-like" data-href="<?php echo get_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share=""></div>
		<div style="float:left;padding-right:5px;">
		<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
		<div style="float:left;padding-right:5px;" class="g-plus" data-action="share" data-annotation="bubble">
		<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/platform.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script></div>
			<div style="float:left;padding-right:5px;">
		<script type="text/javascript" src="//www.redditstatic.com/button/button1.js"></script></div>
		</div>		
<br>
<div id="comments" class="comments">
	<div class="comments-curtain"></div>
	<?php comments_template(); ?>
</div>
</div>
</section>
<?php if( $has_right_col ): ?>
	<section class="entry-content media-content clearfix grid-6 last scrollable-col">
		<?php
		/*
		 *  Loop through a Flexible Content field and display it's content with different views for different layouts
		 */
		while(has_sub_field("media_column")): ?>
			<?php if(get_row_layout() == "picture"): // layout: Picture ?>
				<?php
					$args = [
						'width' => 570,
						'height' => 315,
						'crop' => 1,
						'background_fill' => 'solid'
					];
					$image = get_sub_field('picture_image');
					$img_src = wp_get_attachment_image_src( $image['id'], $args );
					?>
				<img src="<?= $img_src[0]; ?>" alt="<?= $image['alt']; ?>" width="<?= $img_src[1]; ?>" height="<?= $img_src[2]; ?>">
			<?php elseif(get_row_layout() == "video"): // layout: Video ?>
				<?php the_sub_field("video_embedded_code"); ?>
				<div class="collapsible-row">
					<?php if($video_description = get_sub_field("video_description")) : ?>
						<div class="collapsible-wrapper closed">
							<div class="collapsible-handlediv" title="Click to toggle"></div>
							<h3 class="collapsible-hndle">Video Description</h3>
							<div class="collapsible-body"><?= $video_description ?></div>
						</div>
					<?php endif; ?>
					<?php if($video_lyrics = get_sub_field("video_lyrics")) : ?>
						<div class="collapsible-wrapper closed">
							<div class="collapsible-handlediv" title="Click to toggle"></div>
							<h3 class="collapsible-hndle">Lyrics</h3>
							<div class="collapsible-body"><?= $video_lyrics ?></div>
						</div>
					<?php endif; ?>
					<?php if($music_chords = get_sub_field("music_chords")) : ?>
						<div class="collapsible-wrapper closed">
							<div class="collapsible-handlediv" title="Click to toggle"></div>
							<h3 class="collapsible-hndle">Chords / Tabs / Sheet Music</h3>
							<div class="collapsible-body"><?= $music_chords ?></div>
						</div>
					<?php endif; ?>
					<?php if($music_credits = get_sub_field("music_credits")) : ?>
						<div class="collapsible-wrapper closed">
							<div class="collapsible-handlediv" title="Click to toggle"></div>
							<h3 class="collapsible-hndle">Personnel & Production Credits</h3>
							<div class="collapsible-body"><?= $music_credits ?></div>
						</div>
					<?php endif; ?>
				</div>
			<?php elseif(get_row_layout() == "music"): // layout: Music ?>
				<?php the_sub_field("music_embedded_code"); ?>
				<?php the_sub_field("music_description"); ?>
			<?php endif; ?>
		<?php endwhile; ?>
		<?php  wp_reset_postdata(); ?>
	</section>
<?php else: ?>
	<div class="sidebar grid-4 last clearfix" role="complementary">
	 	<div class="new-ad">
<script>
/* 300x250 New Sidebar */
cf_page_artist = "Insert artist variable here";
cf_page_song = "Insert song variable here";
cf_adunit_id = "39384323";
</script>
<script src="//srv.clickfuse.com/showads/showad.js"></script>		</div>
		<br>
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--||||||||||||||||||||||||||||||GEO-LOCATION|||||||||||||||||||||-->
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<div class="concertsb6">
	<h3></h3>
	<div class="zumic-a clearfix">
	     <a href="" target="_blank" style="width:310px;border:none;padding-left:12px;">
            <img style="width:auto!important" src="http://zumic.com/wp-content/uploads/2015/03/zumic-logo-brushed-steel.png" >   
        </a>
	     <div class="sidebar-geotitle">
           <div class="folded"><h2><strong>related artists</strong></h2></div>
           <!--  <hr style="margin-right:15px;margin-left:25px;height:.2%;"> -->
        </div>
	</div>					
<!--   |\\\|||\\|\|\|\\|    -->
<?php
$title = get_the_title();
$posttags = get_the_tags();

if( $title && $posttags ) {
  $result = find_tag_in_title( $title, $posttags );
  //var_dump( $result ); // dump result
  //echo $result . "<br>"; 
}
?>
<?php
$args = array(
	'post_type' =>  'artists',
	'tag_slug__in'   =>  array( $result )
	);
	$m_query = new WP_Query($args);
	if ($m_query->have_posts()) : while ($m_query->have_posts()) :
	$m_query->the_post();
?>
	<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
	</a>
	<div class="single-title">
		<a href="<?php the_permalink() ?>">
			<strong>
				<h3 style="color:white;"><?php the_title(); ?><h3>
			</strong>
		</a>
		</div>
<?php
$timecutoff = date("Y-m-d");
$eventarg = array(
	'post_type'      => 'events',                
	'tag_slug__in'   =>  array( $result ),
	'orderby' => 'meta_value',
    'meta_key' => 'event_date',
    'meta_compare' => '>=',
    'meta_value' => $timecutoff,
    // 'showposts' => 100,
    'posts_per_page' => 350, 
    'order' => 'ASC',
    'ignore_sticky_posts' => true
	);

	$my_query = new WP_Query( $eventarg );
	if ($my_query->have_posts() ) { 
	while ( $my_query->have_posts() ) { 
	$my_query->the_post(); 

	$eventdate = get_post_meta($post->ID, "eventdate", true);
			$event_lat  = get_field( 'gp_latitude' ); 
			$event_long = get_field( 'gp_longitude' ); 
			$earth_radius = 3960.00; # in miles
			$lat_1 = $event_lat;
			$lon_1 = $event_long;
			$lat_2 = $user_lat;
			$lon_2 = $user_long;
			$delta_lat = $lat_2 - $lat_1 ;
			$delta_lon = $lon_2 - $lon_1 ;
			$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
			$max_distance = 70;
			?>

<?php if ($hav_distance <= $max_distance) { ?>

<div class="hov">
	 <?php 
        $perma = get_the_permalink();
        ?>
	<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
		<table class="hoverTable">
              <tr>
                <td style="min-width:55px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
                   
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "d";
                                $datelast = "M";
                                $unixtimestamp = strtotime(get_field('event_date'));

                                echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                   
                        <br>
                        <div style="font-size:30px;width:100%;color:#dddddd;">
                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                         <br>
                             <div style="margin-top:-15px;margin-right:6px;">
                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
                            </div>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;padding-right:10px;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
                        <strong>
                           <?php 
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                            ?>
                        </strong>
                        <br>
                    </div> 
                </td>
                  </tr>
            </table>   
			<br>
	</a>		
</div>	
		<?php } ?>

	<?php
	}
	}
	wp_reset_postdata();
	?>
	<?php endwhile;  ?>
	<?php endif; ?>




<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|   -->
<div class="xx">
	<?php
	$artist_id = $tags[0]->term_id;
	if ($artist_id === null ) { ?>
	<style>
	div.concertsb2 {
	display: none; }
	</style>
	<?php } 
	$args = array(
		'post_type' => 'artists',
		'tag__in'   => array( $artist_id )
		);
		$m_query = new WP_Query($args);
		if ($m_query->have_posts()) : while ($m_query->have_posts()) :
		$m_query->the_post();
	?>
	<div>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
		</a>
		<div class="single-title">
		<a href="<?php the_permalink() ?>">
			<strong>
				<h3 style="color:white;">
							<?php
							 $x = get_the_title();
										if ($x == $result) {
											
										 ?>
										<style type="text/css">
										.xx{display: none;}
										</style>
												
										<?php	}else{
											the_title();
										}	 ?>
					<h3>
			</strong>
		</a>
		</div>
	</div>
	<?php
	$timecutoff = date("Y-m-d");
	$eventarg = array(
		'post_type'      => 'events',                
		'tag__in'        => array( $artist_id ),
		'orderby' => 'meta_value',
	    'meta_key' => 'event_date',
	    'meta_compare' => '>=',
	    'meta_value' => $timecutoff,
	    // 'showposts' => 100,
	    'posts_per_page' => 350, 
	    'order' => 'ASC',
	    'ignore_sticky_posts' => true
		);
		$my_query = new WP_Query( $eventarg );
		if ($my_query->have_posts() ) { 
		while ( $my_query->have_posts() ) { 
		$my_query->the_post(); 
		$eventdate = get_post_meta($post->ID, "eventdate", true);
		$event_lat  = get_field( 'gp_latitude' ); 
		$event_long = get_field( 'gp_longitude' ); 
		$earth_radius = 3960.00; # in miles
		$lat_1 = $event_lat;
		$lon_1 = $event_long;
		$lat_2 = $user_lat;
		$lon_2 = $user_long;
		$delta_lat = $lat_2 - $lat_1 ;
		$delta_lon = $lon_2 - $lon_1 ;
		$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
		$max_distance = 70;
	?>
	<?php if ($hav_distance <= $max_distance) { ?>
	<div class="hov">
		 <?php 
	        $perma = get_the_permalink();
	        ?>
		<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
			<table class="hoverTable">
	              <tr>
	                <td style="min-width:55px;">
	                    <b>
	                        <div class="geo-date" style="font-size:15px;color:white;letter-spacing:.5px;">
	                   
	                            <?php
	                                $dateformatstring = "D";
	                                $datebreak = "d";
	                                $datelast = "M";
	                                $unixtimestamp = strtotime(get_field('event_date'));

	                                echo date_i18n($dateformatstring, $unixtimestamp);
	                            ?>
	                   
	                        <br>
	                        <div style="font-size:30px;width:100%;color:white;">
	                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
	                        </div>
	                         <br>
	                             <div style="margin-top:-15px;margin-right:6px;">
	                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
	                            </div>
	                        </div>
	                    </b>
	                </td>
	                 <td style="min-width:175px!important;padding-right:10px;">
	                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
	                        <strong>
	                           <?php // THE TITLE //
	                               global $post;
	                                $s = $post->post_title;
	                                echo substr($s, 0, strrpos($s, 'on') - 1);
	                            ?>
	                        </strong>
	                        <br>
	                    </div> 
	                </td>
	                  </tr>
	            </table>  
			<br>
		</a>				
	</div>	
	<?php } ?>
	<?php } }
	wp_reset_postdata();
	?>
	<?php endwhile; else: ?>

	<style type="text/css">
	.sidebar-geotitle {
		/*display: none;*/
	}
	</style>
	<div class="nosho">
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
	                            <div class="single-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><h3 style="color:white;"><?php the_title(); ?></h3></a></div>
	                        </div>                     
	                    <?php 
	                        endwhile;
	                        wp_reset_postdata();
	                    ?>
	</div>
	<?php endif; ?>
</div>
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|   -->
<div class="xx1">
<?php
$artist_id1 = $tags[1]->term_id;
$args = array(
	'post_type' => 'artists',
	'orderby'  => 'menu_order post_date',
	'tag__in'   => array( $artist_id1 )
	);
	$m_query = new WP_Query($args);
	if ($m_query->have_posts()) : while ($m_query->have_posts()) :
	$m_query->the_post();
?>
<style>
.nosho{
display: none!important;
}
</style>
<div stlye="">
	<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
	</a>
	<div class="single-title">
	<a href="<?php the_permalink() ?>"><strong>
		<h3 style="color:white;">
				<?php $x1 =	get_the_title();
							if ($x1 == $result) { ?>
							<style type="text/css">
							.xx1{display: none;}
							</style>
									
							<?php	}else{
								the_title();
							}	 ?>
		<h3>
	</strong></a>
	</div>
</div>
<?php
$timecutoff = date("Y-m-d");
$eventarg = array(
	'post_type'      => 'events',                
	'tag__in'        => array( $artist_id1 ),
	'orderby' => 'meta_value',
    'meta_key' => 'event_date',
    'meta_compare' => '>=',
    'meta_value' => $timecutoff,
    // 'showposts' => 100,
    'posts_per_page' => 350, 
    'order' => 'ASC',
    'ignore_sticky_posts' => true
	);
	$my_query = new WP_Query( $eventarg );
	if ($my_query->have_posts() ) { 
	while ( $my_query->have_posts() ) { 
	$my_query->the_post(); 
	$eventdate = get_post_meta($post->ID, "eventdate", true);
	$event_lat  = get_field( 'gp_latitude' ); 
	$event_long = get_field( 'gp_longitude' ); 
	$earth_radius = 3960.00; # in miles
	$lat_1 = $event_lat;
	$lon_1 = $event_long;
	$lat_2 = $user_lat;
	$lon_2 = $user_long;
	$delta_lat = $lat_2 - $lat_1 ;
	$delta_lon = $lon_2 - $lon_1 ;
	$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
	$max_distance = 70;
?>
<?php if ($hav_distance <= $max_distance) { ?>

<div class="hov"> 
	<?php 
        $perma = get_the_permalink();
        ?>
	<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
		<table class="hoverTable">
              <tr>
                <td style="min-width:55px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
                   
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "d";
                                $datelast = "M";
                                $unixtimestamp = strtotime(get_field('event_date'));

                                echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                   
                        <br>
                        <div style="font-size:30px;width:100%;color:#dddddd;">
                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                         <br>
                             <div style="margin-top:-15px;margin-right:6px;">
                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
                            </div>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;padding-right:10px;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
                        <strong>
                           <?php 
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                            ?>
                        </strong>
                        <br>
                    </div> 
                </td>
                  </tr>
            </table>  	
		<br>
	</a>		
</div>	
<?php } ?>
<?php } }
wp_reset_postdata();
?>
<?php endwhile;  ?>
<?php endif; ?>
<br>
</div>
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|   -->
<div class="xx2">
	<?php
	$artist_id2 = $tags[2]->term_id;
	$args = array(
		'post_type' => array( 'artists' ),
		'orderby'  => 'menu_order post_date',
		'tag__in'     => array( $artist_id2 ),
		);
		$m_query = new WP_Query($args);
		if ($m_query->have_posts()) : while ($m_query->have_posts()) :
		$m_query->the_post();
	?>
	<style>
	.nosho{
	display: none;
	}
	</style>
	<div stlye="">
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
		</a>
		<div class="single-title" >
		<a href="<?php the_permalink() ?>">
			<h3 style="color:#ddd;">
			<?php $x2 =	get_the_title();
											if ($x2 == $result) { ?>
											<style type="text/css">
											.xx2{display: none;}
											</style>
													
											<?php	}else{
												the_title();
											}	 ?>
		<h3>
		</a>
		</div><br>
	</div>
	<?php
	$timecutoff = date("Y-m-d");
	$eventarg = array(
		'post_type'      => 'events',                
		'tag__in'        => array( $artist_id2 ),
		'orderby' => 'meta_value',
	    'meta_key' => 'event_date',
	    'meta_compare' => '>=',
	    'meta_value' => $timecutoff,
	    // 'showposts' => 100,
	    'posts_per_page' => 350, 
	    'order' => 'ASC',
	    'ignore_sticky_posts' => true
		);

		$my_query = new WP_Query( $eventarg );
		if ($my_query->have_posts() ) { 
		while ( $my_query->have_posts() ) { 
		$my_query->the_post(); 

		$eventdate = get_post_meta($post->ID, "eventdate", true);
				$event_lat  = get_field( 'gp_latitude' ); 
				$event_long = get_field( 'gp_longitude' ); 
				$earth_radius = 3960.00; # in miles
				$lat_1 = $event_lat;
				$lon_1 = $event_long;
				$lat_2 = $user_lat;
				$lon_2 = $user_long;
				$delta_lat = $lat_2 - $lat_1 ;
				$delta_lon = $lon_2 - $lon_1 ;
				$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
				$max_distance = 70;
				?>

	<?php if ($hav_distance <= $max_distance) { ?>

	<div class="hov">
		 <?php 
	        $perma = get_the_permalink();
	        ?>
		<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
			<table class="hoverTable">
	              <tr>
	                <td style="min-width:55px;">
	                    <b>
	                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
	                   
	                            <?php
	                                $dateformatstring = "D";
	                                $datebreak = "d";
	                                $datelast = "M";
	                                $unixtimestamp = strtotime(get_field('event_date'));

	                                echo date_i18n($dateformatstring, $unixtimestamp);
	                            ?>
	                   
	                        <br>
	                        <div style="font-size:30px;width:100%;color:#dddddd;">
	                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
	                        </div>
	                         <br>
	                             <div style="margin-top:-15px;margin-right:6px;">
	                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
	                            </div>
	                        </div>
	                    </b>
	                </td>
	                 <td style="min-width:175px!important;padding-right:10px;">
	                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
	                        <strong>
	                           <?php 
	                               global $post;
	                                $s = $post->post_title;
	                                echo substr($s, 0, strrpos($s, 'on') - 1);
	                            ?>
	                        </strong>
	                        <br>
	                    </div> 
	                </td>
	                  </tr>
	            </table>   
				<br>
		</a>		
	</div>	
			<?php } ?>

		<?php
		}
		}
		wp_reset_postdata();
		?>
		<?php endwhile;  ?>
		<?php endif; ?>
		
</div>
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<div class="xx3">
<?php
$artist_id3 = $tags[3]->term_id;
$args = array(
	'post_type' => array( 'artists' ),
	'orderby'  => 'menu_order post_date',
	'tag__in'     => array( $artist_id3 ),
	);
	$m_query = new WP_Query($args);
	if ($m_query->have_posts()) : while ($m_query->have_posts()) :
	$m_query->the_post();
?>
<style>
.nosho{
display: none;
}
</style>
<div stlye="">
	<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
	</a>
	<div class="single-title">
		<a href="<?php the_permalink() ?>">
				<h3 style="color:white;">
						<?php $x3 =	get_the_title();
											if ($x3 == $result) { ?>
											<style type="text/css">
											.xx3{display: none;}
											</style>
													
											<?php	}else{
												the_title();
											}	 ?>
			<h3>
		</a>
	</div>
</div>
<?php
$timecutoff = date("Y-m-d");
$eventarg = array(
	'post_type'      => 'events',                
	'tag__in'        => array( $artist_id3 ),
	'orderby' => 'meta_value',
    'meta_key' => 'event_date',
    'meta_compare' => '>=',
    'meta_value' => $timecutoff,
    // 'showposts' => 100,
    'posts_per_page' => 350, 
    'order' => 'ASC',
    'ignore_sticky_posts' => true
	);

	$my_query = new WP_Query( $eventarg );
	if ($my_query->have_posts() ) { 
	while ( $my_query->have_posts() ) { 
	$my_query->the_post(); 

	$eventdate = get_post_meta($post->ID, "eventdate", true);
			$event_lat  = get_field( 'gp_latitude' ); 
			$event_long = get_field( 'gp_longitude' ); 
			$earth_radius = 3960.00; # in miles
			$lat_1 = $event_lat;
			$lon_1 = $event_long;
			$lat_2 = $user_lat;
			$lon_2 = $user_long;
			$delta_lat = $lat_2 - $lat_1 ;
			$delta_lon = $lon_2 - $lon_1 ;
			$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
			$max_distance = 70;
			?>

<?php if ($hav_distance <= $max_distance) { ?>

<div class="hov">
	 <?php 
        $perma = get_the_permalink();
        ?>
	<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
		<table class="hoverTable">
              <tr>
                <td style="min-width:55px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
                   
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "d";
                                $datelast = "M";
                                $unixtimestamp = strtotime(get_field('event_date'));

                                echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                   
                        <br>
                        <div style="font-size:30px;width:100%;color:#dddddd;">
                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                         <br>
                             <div style="margin-top:-15px;margin-right:6px;">
                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
                            </div>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;padding-right:10px;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
                        <strong>
                           <?php 
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                            ?>
                        </strong>
                        <br>
                    </div> 
                </td>
                  </tr>
            </table>  
			<br>
	</a>		
</div>	
		<?php } ?>

	<?php
	}
	}
	wp_reset_postdata();
	?>
	<?php endwhile;  ?>
	<?php endif; ?>
</div>
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|   -->
<div class="xx4">
<?php
$artist_id4 = $tags[4]->term_id;
$args = array(
	'post_type' => array( 'artists' ),
	'orderby'  => 'menu_order post_date',
	'tag__in'     => array( $artist_id4 ),
	);
	$m_query = new WP_Query($args);
	if ($m_query->have_posts()) : while ($m_query->have_posts()) :
	$m_query->the_post();
?>
<style>
.nosho{
display: none;
}
</style>
<div stlye="">
	<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
	</a>
	<div class="single-title">
		<a href="<?php the_permalink() ?>">
				<h3 style="color:#ddd;">
				<?php $x4 =	get_the_title();
											if ($x4 == $result) { ?>
											<style type="text/css">
											.xx4{display: none;}
											</style>
													
											<?php	}else{
												the_title();
											}	 ?>
			<h3>
		</a>
	</div>
</div>
<?php
$timecutoff = date("Y-m-d");
$eventarg = array(
	'post_type'      => 'events',                
	'tag__in'        => array( $artist_id4 ),
	'orderby' => 'meta_value',
    'meta_key' => 'event_date',
    'meta_compare' => '>=',
    'meta_value' => $timecutoff,
    // 'showposts' => 100,
    'posts_per_page' => 350, 
    'order' => 'ASC',
    'ignore_sticky_posts' => true
	);

	$my_query = new WP_Query( $eventarg );
	if ($my_query->have_posts() ) { 
	while ( $my_query->have_posts() ) { 
	$my_query->the_post(); 

	$eventdate = get_post_meta($post->ID, "eventdate", true);
			$event_lat  = get_field( 'gp_latitude' ); 
			$event_long = get_field( 'gp_longitude' ); 
			$earth_radius = 3960.00; # in miles
			$lat_1 = $event_lat;
			$lon_1 = $event_long;
			$lat_2 = $user_lat;
			$lon_2 = $user_long;
			$delta_lat = $lat_2 - $lat_1 ;
			$delta_lon = $lon_2 - $lon_1 ;
			$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
			$max_distance = 70;
			?>

<?php if ($hav_distance <= $max_distance) { ?>

<div class="hov">
	 <?php 
        $perma = get_the_permalink();
        ?>
	<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
		<table class="hoverTable">
              <tr>
                <td style="min-width:55px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
                   
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "d";
                                $datelast = "M";
                                $unixtimestamp = strtotime(get_field('event_date'));

                                echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                   
                        <br>
                        <div style="font-size:30px;width:100%;color:#dddddd;">
                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                         <br>
                             <div style="margin-top:-15px;margin-right:6px;">
                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
                            </div>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;padding-right:10px;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
                        <strong>
                           <?php 
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                            ?>
                        </strong>
                        <br>
                    </div> 
                </td>
                  </tr>
            </table>  	
			<br>
	</a>		
</div>	
		<?php } ?>

	<?php
	}
	}
	wp_reset_postdata();
	?>
	<?php endwhile;  ?>
	<?php endif; ?>
</div>	
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|   -->
<div class="xx5">
<?php
$artist_id5 = $tags[5]->term_id;
$args = array(
	'post_type' => array( 'artists' ),
	'orderby'  => 'menu_order post_date',
	'tag__in'     => array( $artist_id5 ),
	);
	$m_query = new WP_Query($args);
	if ($m_query->have_posts()) : while ($m_query->have_posts()) :
	$m_query->the_post();
?>
<style>
.nosho{
display: none;
}
</style>
<div stlye="">
	<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
	</a>
	<div class="single-title">
	<a href="<?php the_permalink() ?>">
		<h3 style="color:white;">
			<?php $x5 =	get_the_title();
											if ($x5 == $result) { ?>
											<style type="text/css">
											.xx5{display: none;}
											</style>
													
											<?php	}else{
												the_title();
											}	 ?>
		<h3>
	</a>
	</div>
</div>
<?php
$timecutoff = date("Y-m-d");
$eventarg = array(
	'post_type'      => 'events',                
	'tag__in'        => array( $artist_id5 ),
	'orderby' => 'meta_value',
    'meta_key' => 'event_date',
    'meta_compare' => '>=',
    'meta_value' => $timecutoff,
    // 'showposts' => 100,
    'posts_per_page' => 350, 
    'order' => 'ASC',
    'ignore_sticky_posts' => true
	);
	$my_query = new WP_Query( $eventarg );
	if ($my_query->have_posts() ) { 
	while ( $my_query->have_posts() ) { 
	$my_query->the_post(); 

	$eventdate = get_post_meta($post->ID, "eventdate", true);
			$event_lat  = get_field( 'gp_latitude' ); 
			$event_long = get_field( 'gp_longitude' ); 
			$earth_radius = 3960.00; # in miles
			$lat_1 = $event_lat;
			$lon_1 = $event_long;
			$lat_2 = $user_lat;
			$lon_2 = $user_long;
			$delta_lat = $lat_2 - $lat_1 ;
			$delta_lon = $lon_2 - $lon_1 ;
			$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
			$max_distance = 70;
			?>

<?php if ($hav_distance <= $max_distance) { ?>

<div class="hov">
	 <?php 
        $perma = get_the_permalink();
        ?>
	<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
		<table class="hoverTable">
              <tr>
                <td style="min-width:55px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
                   
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "d";
                                $datelast = "M";
                                $unixtimestamp = strtotime(get_field('event_date'));

                                echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                   
                        <br>
                        <div style="font-size:30px;width:100%;color:#dddddd;">
                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                         <br>
                             <div style="margin-top:-15px;margin-right:6px;">
                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
                            </div>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;padding-right:10px;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
                        <strong>
                           <?php 
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                            ?>
                        </strong>
                        <br>
                    </div> 
                </td>
                  </tr>
            </table> 	
			<br>
	</a>		
</div>	
		<?php } ?>

	<?php
	}
	}
	wp_reset_postdata();
	?>
	<?php endwhile;  ?>
	<?php endif; ?>
</div>
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|   -->
<div class="xx6">
<?php
$artist_id6 = $tags[6]->term_id;
$args = array(
	'post_type' => array( 'artists' ),
	'orderby'  => 'menu_order post_date',
	'tag__in'     => array( $artist_id6 ),
	);
	$m_query = new WP_Query($args);
	if ($m_query->have_posts()) : while ($m_query->have_posts()) :
	$m_query->the_post();
?>
<style>
.nosho{
display: none;
}
</style>
<div stlye="">
	<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
	</a>
	<div class="single-title">
		<a href="<?php the_permalink() ?>">
			<h3 style="color:#ddd;">
				<?php $x6 =	get_the_title();
											if ($x6 == $result) { ?>
											<style type="text/css">
											.xx6{display: none;}
											</style>
													
											<?php	}else{
												the_title();
											}	 ?>
			<h3>
		</a>
	</div>
</div>
<?php
$timecutoff = date("Y-m-d");
$eventarg = array(
	'post_type'      => 'events',                
	'tag__in'        => array( $artist_id6 ),
	'orderby' => 'meta_value',
    'meta_key' => 'event_date',
    'meta_compare' => '>=',
    'meta_value' => $timecutoff,
    // 'showposts' => 100,
    'posts_per_page' => 350, 
    'order' => 'ASC',
    'ignore_sticky_posts' => true
	);

	$my_query = new WP_Query( $eventarg );
	if ($my_query->have_posts() ) { 
	while ( $my_query->have_posts() ) { 
	$my_query->the_post(); 

	$eventdate = get_post_meta($post->ID, "eventdate", true);
			$event_lat  = get_field( 'gp_latitude' ); 
			$event_long = get_field( 'gp_longitude' ); 
			$earth_radius = 3960.00; # in miles
			$lat_1 = $event_lat;
			$lon_1 = $event_long;
			$lat_2 = $user_lat;
			$lon_2 = $user_long;
			$delta_lat = $lat_2 - $lat_1 ;
			$delta_lon = $lon_2 - $lon_1 ;
			$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
			$max_distance = 70;
			?>

<?php if ($hav_distance <= $max_distance) { ?>

<div class="hov">
	 <?php 
        $perma = get_the_permalink();
        ?>
	<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
		<table class="hoverTable">
              <tr>
                <td style="min-width:55px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
                   
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "d";
                                $datelast = "M";
                                $unixtimestamp = strtotime(get_field('event_date'));

                                echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                   
                        <br>
                        <div style="font-size:30px;width:100%;color:#dddddd;">
                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                         <br>
                             <div style="margin-top:-15px;margin-right:6px;">
                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
                            </div>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;padding-right:10px;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
                        <strong>
                           <?php 
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                            ?>
                        </strong>
                        <br>
                    </div> 
                </td>
                  </tr>
            </table> 
			<br>
	</a>		
</div>	
		<?php } ?>

	<?php
	}
	}
	wp_reset_postdata();
	?>
	<?php endwhile;  ?>
	<?php endif; ?>
</div>
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|   -->
<div class="xx7">
<?php
$artist_id7 = $tags[7]->term_id;
$args = array(
	'post_type' => array( 'artists' ),
	'orderby'  => 'menu_order post_date',
	'tag__in'     => array( $artist_id7 ),
	);
	$m_query = new WP_Query($args);
	if ($m_query->have_posts()) : while ($m_query->have_posts()) :
	$m_query->the_post();
?>
<style>
.nosho{
display: none;
}
</style>
<div stlye="">
	<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
	</a>
	<div class="single-title">
		<a href="<?php the_permalink() ?>">
			<h3 style="color:#ddd;">
				<?php $x7 =	get_the_title();
											if ($x7 == $result) { ?>
											<style type="text/css">
											.xx7{display: none;}
											</style>
													
											<?php	}else{
												the_title();
											}	 ?>
			<h3>
		</a>
	</div>
</div>
<?php
$timecutoff = date("Y-m-d");
$eventarg = array(
	'post_type'      => 'events',                
	'tag__in'        => array( $artist_id7 ),
	'orderby' => 'meta_value',
    'meta_key' => 'event_date',
    'meta_compare' => '>=',
    'meta_value' => $timecutoff,
    // 'showposts' => 100,
    'posts_per_page' => 350, 
    'order' => 'ASC',
    'ignore_sticky_posts' => true
	);

	$my_query = new WP_Query( $eventarg );
	if ($my_query->have_posts() ) { 
	while ( $my_query->have_posts() ) { 
	$my_query->the_post(); 

	$eventdate = get_post_meta($post->ID, "eventdate", true);
			$event_lat  = get_field( 'gp_latitude' ); 
			$event_long = get_field( 'gp_longitude' ); 
			$earth_radius = 3960.00; # in miles
			$lat_1 = $event_lat;
			$lon_1 = $event_long;
			$lat_2 = $user_lat;
			$lon_2 = $user_long;
			$delta_lat = $lat_2 - $lat_1 ;
			$delta_lon = $lon_2 - $lon_1 ;
			$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
			$max_distance = 70;
			?>

<?php if ($hav_distance <= $max_distance) { ?>
<div class="hov">
	 <?php 
        $perma = get_the_permalink();
        ?>
	<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
		<table class="hoverTable">
              <tr>
                <td style="min-width:55px;">
                    <b>
                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
                   
                            <?php
                                $dateformatstring = "D";
                                $datebreak = "d";
                                $datelast = "M";
                                $unixtimestamp = strtotime(get_field('event_date'));

                                echo date_i18n($dateformatstring, $unixtimestamp);
                            ?>
                   
                        <br>
                        <div style="font-size:30px;width:100%;color:#dddddd;">
                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
                        </div>
                         <br>
                             <div style="margin-top:-15px;margin-right:6px;">
                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
                            </div>
                        </div>
                    </b>
                </td>
                 <td style="min-width:175px!important;padding-right:10px;">
                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
                        <strong>
                           <?php 
                               global $post;
                                $s = $post->post_title;
                                echo substr($s, 0, strrpos($s, 'on') - 1);
                            ?>
                        </strong>
                        <br>
                    </div> 
                </td>
                  </tr>
            </table>  	
			<br>
	</a>		
</div>	
		<?php } ?>

	<?php
	}
	}
	wp_reset_postdata();
	?>
	<?php endwhile;  ?>
	<?php endif; ?>
</div>
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|   -->
<div class="xx8">
	<?php
	$artist_id8 = $tags[8]->term_id;
	$args = array(
		'post_type' => array( 'artists' ),
		'tag__in'     => array( $artist_id8 ),
		);
		$m_query = new WP_Query($args);
		if ($m_query->have_posts()) : while ($m_query->have_posts()) :
		$m_query->the_post();
	?>
	<div stlye="">
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
		</a>
		<div class="single-title">
			<a href="<?php the_permalink() ?>">
				<h3 style="color:#ddd;">
					<?php $x8 =	get_the_title();
												if ($x8 == $result) { ?>
												<style type="text/css">
												.xx8{display: none;}
												</style>
														
												<?php	}else{
													the_title();
												}	 ?>
				<h3>
			</a>
		</div>
	</div>
	<?php
	$timecutoff = date("Y-m-d");
	$eventarg = array(
		'post_type'      => 'events',                
		'tag__in'        => array( $artist_id8 ),
		'orderby' => 'meta_value',
	    'meta_key' => 'event_date',
	    'meta_compare' => '>=',
	    'meta_value' => $timecutoff,
	    // 'showposts' => 100,
	    'posts_per_page' => 350, 
	    'order' => 'ASC',
	    'ignore_sticky_posts' => true
		);

		$my_query = new WP_Query( $eventarg );
		if ($my_query->have_posts() ) { 
		while ( $my_query->have_posts() ) { 
		$my_query->the_post(); 

		$eventdate = get_post_meta($post->ID, "eventdate", true);
				$event_lat  = get_field( 'gp_latitude' ); 
				$event_long = get_field( 'gp_longitude' ); 
				$earth_radius = 3960.00; # in miles
				$lat_1 = $event_lat;
				$lon_1 = $event_long;
				$lat_2 = $user_lat;
				$lon_2 = $user_long;
				$delta_lat = $lat_2 - $lat_1 ;
				$delta_lon = $lon_2 - $lon_1 ;
				$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
				$max_distance = 70;
				?>

	<?php if ($hav_distance <= $max_distance) { ?>
		
	<div class="hov">
		 <?php 
	        $perma = get_the_permalink();
	        ?>
		<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
			<table class="hoverTable">
	              <tr>
	                <td style="min-width:55px;">
	                    <b>
	                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
	                   
	                            <?php
	                                $dateformatstring = "D";
	                                $datebreak = "d";
	                                $datelast = "M";
	                                $unixtimestamp = strtotime(get_field('event_date'));

	                                echo date_i18n($dateformatstring, $unixtimestamp);
	                            ?>
	                   
	                        <br>
	                        <div style="font-size:30px;width:100%;color:#dddddd;">
	                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
	                        </div>
	                         <br>
	                             <div style="margin-top:-15px;margin-right:6px;">
	                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
	                            </div>
	                        </div>
	                    </b>
	                </td>
	                 <td style="min-width:175px!important;padding-right:10px;">
	                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
	                        <strong>
	                           <?php 
	                               global $post;
	                                $s = $post->post_title;
	                                echo substr($s, 0, strrpos($s, 'on') - 1);
	                            ?>
	                        </strong>
	                        <br>
	                    </div> 
	                </td>
	                  </tr>
	            </table>   	
				<br>
		</a>
			
	</div>	
			<?php } ?>

		<?php
		}
		}
		wp_reset_postdata();
		?>
		<?php endwhile;  ?>
		<?php endif; ?>
</div>
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|    -->
<!--   |\\\|||\\|\|\|\\|   -->
<div class="xx9">
	<?php
	$artist_id9 = $tags[9]->term_id;
	$args = array(
		'post_type' => array( 'artists' ),
		'tag__in'     => array( $artist_id9 ),
		);
		$m_query = new WP_Query($args);
		if ($m_query->have_posts()) : while ($m_query->have_posts()) :
		$m_query->the_post();
	?>
	<div stlye="">
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
		</a>
		<div class="single-title">
			<a href="<?php the_permalink() ?>">
					<h3 style="color:#ddd;">
					<?php $x9 =	get_the_title();
												if ($x9 == $result) { ?>
												<style type="text/css">
												.xx9{display: none;}
												</style>
														
												<?php	}else{
													the_title();
												}	 ?>
				<h3>
			</a>
		</div>
	</div>
	<?php
	$timecutoff = date("Y-m-d");
	$eventarg = array(
		'post_type'      => 'events',                
		'tag__in'        => array( $artist_id9 ),
		'orderby' => 'meta_value',
	    'meta_key' => 'event_date',
	    'meta_compare' => '>=',
	    'meta_value' => $timecutoff,
	    // 'showposts' => 100,
	    'posts_per_page' => 350, 
	    'order' => 'ASC',
	    'ignore_sticky_posts' => true
		);

		$my_query = new WP_Query( $eventarg );
		if ($my_query->have_posts() ) { 
		while ( $my_query->have_posts() ) { 
		$my_query->the_post(); 

		$eventdate = get_post_meta($post->ID, "eventdate", true);
				$event_lat  = get_field( 'gp_latitude' ); 
				$event_long = get_field( 'gp_longitude' ); 
				$earth_radius = 3960.00; # in miles
				$lat_1 = $event_lat;
				$lon_1 = $event_long;
				$lat_2 = $user_lat;
				$lon_2 = $user_long;
				$delta_lat = $lat_2 - $lat_1 ;
				$delta_lon = $lon_2 - $lon_1 ;
				$hav_distance = distance_haversine($lat_1, $lon_1, $lat_2, $lon_2);	
				$max_distance = 70;
				?>

	<?php if ($hav_distance <= $max_distance) { ?>

	<div class="hov">
	 <?php 
	        $perma = get_the_permalink();
	        ?>
		<a href="<?php echo $perma . "?sidebar-music"; ?>" title="<?php the_title_attribute(); ?>">
			<table class="hoverTable">
	              <tr>
	                <td style="min-width:55px;">
	                    <b>
	                        <div class="geo-date" style="font-size:15px;color:#dddddd;letter-spacing:.5px;">
	                   
	                            <?php
	                                $dateformatstring = "D";
	                                $datebreak = "d";
	                                $datelast = "M";
	                                $unixtimestamp = strtotime(get_field('event_date'));

	                                echo date_i18n($dateformatstring, $unixtimestamp);
	                            ?>
	                   
	                        <br>
	                        <div style="font-size:30px;width:100%;color:#dddddd;">
	                            <?php  echo date_i18n($datebreak, $unixtimestamp); ?>
	                        </div>
	                         <br>
	                             <div style="margin-top:-15px;margin-right:6px;">
	                                <?php  echo date_i18n($datelast , $unixtimestamp); ?>
	                            </div>
	                        </div>
	                    </b>
	                </td>
	                 <td style="min-width:175px!important;padding-right:10px;">
	                    <div class="geo-title" style="font-size:15px;color:black;letter-spacing:1px;text-align:left;">
	                        <strong>
	                           <?php 
	                               global $post;
	                                $s = $post->post_title;
	                                echo substr($s, 0, strrpos($s, 'on') - 1);
	                            ?>
	                        </strong>
	                        <br>
	                    </div> 
	                </td>
	                  </tr>
	            </table>   	
				
		</a>

	</div>	
	<?php } ?>
		<?php
		}
		}
		wp_reset_postdata();
		?>
		<?php endwhile;  ?>
		<?php endif; ?>
</div>
<!--   |\\\|||\\|\|\|\\|    -->
 <div class="zumic-a clearfix">
        <h3>Powered By</h3>
        <a href="https://www.superstartickets.com/Concerts" target="_blank" style="width:310px;border:none;padding-left:12px;">
            <img  src="http://zumic.com/wp-content/uploads/2015/03/SUPERSTAR_LOGOv2-03-11.jpg" >   
        </a>
        
    </div> 
</div>

<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
<!--||||||||||||||||END||||||||||||GEO-LOCATION|||||||||||||||||||||-->
<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->	
<br>
<div class="sidecenter2">
			<div class="block-newsletter-signup2 clearfix">
				<?php include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
			</div>
	 	</div>
	
								   <?php //echo get_adsense( get_the_ID(), '5470875933', '336x280'); ?>
								<div class="zumic-a clearfix">	</div>
							

										<?php get_sidebar(); ?>
									</div>
								<?php endif; ?>
								<footer class="article-footer"></footer>
							</article>
							<?php endwhile; ?>
							<?php else : ?>
									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>
							<?php endif; ?>
						</div>
						<?php 
							// global $post;
							// $tags = wp_get_post_tags( $post->ID, ['fields' => 'ids'] );
							// $types = array( 'music-videos' );
							// $related_artists = get_related_artists_by_tags( $types, get_the_ID(), $tags );
							
							// if( $related_artists->posts ):
							if( false ):
						?>
						<div class="block-related-music clearfix">
							<h1>Related Music</h1>
							<?php
									$i = 1;
									foreach( $related_artists->posts as $post ):
										setup_postdata( $post );
							?>
									<div class="related-posts-item entry-content clearfix grid-3<?php if($i % 4 == 0) echo ' last'; ?>">
										<div class="img-wrapper">
											<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
												<?php the_post_thumbnail( 'related-thumb' ); ?>
											</a>
										</div>
										<div class="post-date"><?php echo get_the_time('M j, Y'); ?></div>
										<div class="title-wrapper">
											<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
												<?php echo get_the_title(); ?>
											</a>
										</div>
									</div>
							<?php $i++; endforeach; ?>
						</div>
						<?php endif; ?>

						<div class="block-related clearfix sidebar">

							<div class="zumic-a clearfix">
								<?php echo get_responsive_adsense( get_the_ID(), '2919205536' ); ?>
							</div>
							
								<div class="block-related-latest-news grid-4 last">
										<?php 
											echo '<h2 class="title-headline">POPULAR TODAY</h2>';
											include( TEMPLATEPATH . "/parts/latest-news-sm.php" );
									?>
								</div>
								<?php // if( $has_right_col ): ?>
									<div class="block-related-music grid-4">
										<?php echo show_related_posts( ['music-videos'], 4, 'sm-thumb', 0, 'Related Music' ); ?>
									</div>
								<?php // endif; ?>
								<div class="news-mobile">
									<div class="block-related-news grid-4">
										<?php echo show_related_posts( ['post'], 4, 'sm-thumb', 0, 'Related News' ); ?>
									</div>
								</div>
						</div>


						
			</div>
			

<?php get_footer(); ?>





