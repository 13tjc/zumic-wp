<?php
/**
 * Music location taxonomy page
 */
?>
<style>
.post .kk-star-ratings.lft{
display: none;
}
.post .authorstars p{
    display: none;
}
</style>
<?php get_header(); ?>
<?php
	$queried_object = get_queried_object();
	$term_id = $queried_object->term_id;
	$location = get_tax_meta( $term_id, 'location_term_meta' );
	$args = array(
		'post_type' => array( 'post', 'music-videos' ),
		'posts_per_page' => 20,
		'paged' => get_query_var('paged'),
		'tax_query' => array(
			array(
				'taxonomy' => 'local-music',
				'field' => 'id',
				'terms' => array( $term_id ),
			)
		)
	);
	query_posts($args);
?>

	<div id="content">
		<div id="inner-content" class="wrap clearfix">
				

		<div id="main" class="grid-8 first clearfix" role="main" >
    		<div class="body-border2">



						    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style2.css" />
						    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.2.6.min.js"></script>
						    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-easing-1.3.pack.js"></script>
						    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-easing-compatibility.1.2.pack.js"></script>
						    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/coda-slider.1.1.1.pack.js"></script>
						<script type="text/javascript">
						    
						        var theInt = null;
						        var $crosslink, $navthumb;
						        var curclicked = 0;
						        
						        theInterval = function(cur){
						            clearInterval(theInt);
						            
						            if( typeof cur != 'undefined' )
						                curclicked = cur;
						            
						            $crosslink.removeClass("active-thumb");
						            $navthumb.eq(curclicked).parent().addClass("active-thumb");
						                $(".stripNav ul li a").eq(curclicked).trigger('click');
						            
						            theInt = setInterval(function(){
						                $crosslink.removeClass("active-thumb");
						                $navthumb.eq(curclicked).parent().addClass("active-thumb");
						                $(".stripNav ul li a").eq(curclicked).trigger('click');
						                curclicked++;
						                if( 6 == curclicked )
						                    curclicked = 0;
						                
						            }, 3500);
						        };
						        
						        $(function(){
						            $("#page-wrap").show();
						            $("#main-photo-slider").codaSlider();
						            
						            $navthumb = $(".nav-thumb");
						            $crosslink = $(".cross-link");
						            
						            // $navthumb
						            // .click(function() {
						            //     var $this = $(this);
						            //     theInterval($this.parent().attr('id').slice(1) - 1);
						            //     return false;
						            // });
						            // theInterval();
						             $navthumb
						            .hover(function() {
						                var $this = $(this);
						                theInterval($this.parent().attr('id').slice(1) - 1);
						                return false;
						            });
						            
						            theInterval();
						        });
						    </script>

						<br>
						<div id="page-wrap" style="display:none;">                                
						    <div class="slider-wrap">
						        <div id="main-photo-slider" class="csw" >
						            <div class="panelContainer">
						                <?php  $queried_object = get_queried_object();
						                $term_id = $queried_object->term_id;
						                $args = array('post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby' => 'menu_order post_date','date_query' => array( array(
						                        'after' => '30 days ago' ) ),
						                'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    )

						                );
						                      $loop = new WP_Query( $args ); ?>
						                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						                <div class="panel" title="Panel 1">
						                    <div class="wrapper">
						                        <center style="vertical-align:middle;">
						                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                <?php the_post_thumbnail( 'post-img-l' ); ?>
						                            </a> 
						                        </center>
						                    </div>
						                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
						                            <div class="stitle">
						                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                    <?php the_title(); ?>
						                                </a></h2>
						                            </div>
						                        </div> 
						                </div>
						                 <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						           <!-- /||||||||||||||||||||||||||||||||||| -->
						                <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 1,'date_query' => array( array(
						                        'after' => '30 days ago') ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ));
						                      $loop = new WP_Query( $args ); ?>
						                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						                  <div class="panel" title="Panel 2">
						                    <div class="wrapper">
						                        <center style="vertical-align:middle;">
						                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                <?php the_post_thumbnail( 'post-img-l' ); ?>
						                            </a>
						                        </center>
						                    </div>
						                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
						                             <div class="stitle">
						                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                    <?php the_title(); ?>
						                                </a></h2>
						                            </div>
						                        </div>
						                </div>
						                 <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						           <!-- /||||||||||||||||||||||||||||||||||| -->  
						                <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 2,'date_query' => array( array(
						                        'after' => '30 days ago') ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ));
						                      $loop = new WP_Query( $args ); ?>
						                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						                <div class="panel" title="Panel 3">
						                    <div class="wrapper">
						                        <center style="vertical-align:middle;">
						                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                <?php the_post_thumbnail( 'post-img-l' ); ?>
						                            </a>
						                        </center>
						                    </div>
						                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
						                            <div class="stitle">
						                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                    <?php the_title(); ?>
						                                </a></h2>
						                            </div>
						                        </div>
						                </div>
						                 <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						           <!-- /||||||||||||||||||||||||||||||||||| -->  
						                <?php
						                    $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 3,
						                          'date_query' => array( array('after' => '30 days ago') ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ));
						                    $loop = new WP_Query( $args );
						                    ?>
						                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
						                <div class="panel" title="Panel 4">
						                    <div class="wrapper">
						                        <center style="vertical-align:middle;">
						                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                              <?php the_post_thumbnail( 'post-img-l' ); ?>
						                            </a>
						                        </center>
						                    </div>
						                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
						                             <div class="stitle">
						                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                    <?php the_title(); ?>
						                                </a></h2>
						                            </div>
						                        </div>
						                </div>
						                 <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						           <!-- /||||||||||||||||||||||||||||||||||| --> 
						                <?php
						                    $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 4,
						                          'date_query' => array( array('after' => '30 days ago' ) ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ) );
						                    $loop = new WP_Query( $args );
						                    ?>
						                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
						                <div class="panel" title="Panel 5">
						                    <div class="wrapper">
						                        <center style="vertical-align:middle;">
						                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                <?php the_post_thumbnail( 'post-img-l' ); ?>
						                            </a>
						                        </center>
						                    </div>
						                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
						                             <div class="stitle">
						                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                    <?php the_title(); ?>
						                                </a></h2>
						                            </div>
						                        </div>
						                </div>
						                 <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						           <!-- /||||||||||||||||||||||||||||||||||| --> 
						                <?php
						                    $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 5,
						                          'date_query' => array( array('after' => '30 days ago') ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ) );
						                    $loop = new WP_Query( $args );
						                    ?>
						                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
						                <div class="panel" title="Panel 6">
						                    <div class="wrapper">
						                        <center style="vertical-align:middle;">
						                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                               <?php the_post_thumbnail( 'post-img-l' ); ?>
						                            </a>
						                        </center>
						                    </div>
						                        <div class="photo-meta-data" style="background-color:black;height:auto;margin-top:-10px;">
						                             <div class="stitle">
						                                <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
						                                    <?php the_title(); ?>
						                                </a></h2>
						                            </div>
						                        </div>
						                </div>
						                 <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						           <!-- /||||||||||||||||||||||||||||||||||| --> 
						            </div>
						        </div>
						        <div class="thumb-box">
						                 <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','date_query' => array( array(
						                                'after' => '30 days ago' ) ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ));
						                       $loop = new WP_Query( $args ); ?>
						                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
						                   <div class="containers">     
						                            <a  id="#1" href="<?php the_permalink() ?>" class="cross-link" >
						                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
						                            </a>
						                    </div>
						                    <div class="space">a</div>
						                <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						                
						                    <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 1,'date_query' => array( array(
						                                'after' => '30 days ago' ) ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ));
						                          $loop = new WP_Query( $args ); ?>
						                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						                    <div class="containers">     
						                            <a  id="#2" href="<?php the_permalink() ?>" class="cross-link" >
						                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
						                            </a>
						                    </div> 
						                    <div class="space">a</div>
						                <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						                    <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 2,'date_query' => array( array(
						                                'after' => '30 days ago' ) ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ));
						                          $loop = new WP_Query( $args ); ?>
						                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
						                    <div class="containers">     
						                            <a  id="#3" href="<?php the_permalink() ?>" class="cross-link" >
						                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
						                            </a>
						                    </div>
						                    <div class="space">a</div>
						                <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						                   <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 3,'date_query' => array( array(
						                                'after' => '30 days ago' ) ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ));
						                          $loop = new WP_Query( $args ); ?>
						                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
						                    <div class="containers">     
						                            <a  id="#4" href="<?php the_permalink() ?>" class="cross-link" >
						                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
						                            </a>
						                    </div>
						                    <div class="space">a</div>
						                <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						                    <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 4,'date_query' => array( array(
						                                'after' => '30 days ago' ) ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ));
						                          $loop = new WP_Query( $args ); ?>
						                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
						                    <div class="containers">     
						                            <a  id="#5" href="<?php the_permalink() ?>" class="cross-link" >
						                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
						                            </a>
						                    </div>
						                    <div class="space">a</div>
						                     <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						                    <?php $args = array( 'post_type' => array('post', 'music-videos'),'posts_per_page' => 1,'orderby'  => 'menu_order post_date','offset' => 5, 'date_query' => array( array(
						                                'after' => '30 days ago' ) ),'tax_query' => array(
						                        array(
						                            'taxonomy' => 'local-music',
						                            'field' => 'id',
						                            'terms' => array( $term_id ),
						                        )
						                    ));
						                          $loop = new WP_Query( $args ); ?>
						                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
						                    <div class="containers">     
						                            <a  id="#6" href="<?php the_permalink() ?>" class="cross-link" >
						                                <img id="my-img" src="<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>" class="nav-thumb" alt="temp-thumb" />
						                            </a>
						                    </div>
						                     <?php endwhile; ?>
						                <?php wp_reset_postdata(); ?>
						        
						        </div>
						    </div>
						</div>
						<br><br>
						<br><br>
						<br><br><br><br>

					<div class="folded2">
						<h1 class="title-headline"><?php single_cat_title(); ?></h1>
					</div>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix articles-list' ); ?> role="article">

						<header class="article-header">
							<h2 class=""><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							<p class="byline vcard"><?php
								printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'bonestheme' )), bones_get_the_author_posts_link());
							?></p>

						</header>

						<section class="entry-content clearfix">
							<div class="centerimg">    
								<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail( 'related-thumb' ); ?>
								</a>
							</div>
							<div class="excerpt" style="color:white;">
								<?php the_excerpt(); ?>
							</div><br><br>
							  <div class="home-rating">
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
                         
		                    <br>
		                    <br>

							
						</section>

						<footer class="article-footer">

						</footer>

					</article>

					<?php endwhile; ?>

							<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
								<?php wp_reset_query(); ?>
								<?php bones_page_navi(); ?>
							<?php } else { ?>
								<nav class="wp-prev-next">
									<ul class="clearfix">
										<li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
										<li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
									</ul>
								</nav>
							<?php } ?>

					<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
								</section>
								<footer class="article-footer">
										<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
								</footer>
							</article>

											<?php endif; ?>
						  <div class="zumic-a clearfix" style="width:100%; padding-left:12px;">
						                  <?php echo get_responsive_adsense( get_the_ID(), '4683217536' ); ?>
						              </div>

			</div>
		</div>
				<div class="sidebar grid-4 last clearfix" role="complementary"  style="background:#191919;  border: 1px solid;
    border-radius: 5px;padding:5px">
					

					<!-- <div id='map'></div>

					<?php if($location) : ?>
						<div id='concerts'>
							<h2 class="title-headline">Concert Calendar</h2>
							<table class="table table-striped concert-calendar">
								<thead>
									<tr>
										<th>Date</th>
										<th>Artist</th>
										<th>Tickets</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					<?php endif; ?> -->

					<?php get_sidebar(); ?>
					 <div class="new-ad">
            <script>
           
/* 300x250 New Sidebar */
cf_page_artist = "Insert artist variable here";
cf_page_song = "Insert song variable here";
cf_adunit_id = "39384323";
</script>
<script src="//srv.clickfuse.com/showads/showad.js"></script>
        </div>
	<h2 class='title-headline' style="font-size: 27px;">Concert calendar</h2>
                    



     <?php
        $queried_object = get_queried_object();
        $term_id = $queried_object->term_id;
        $timecutoff = date("Y-m-d");
        $args = array(
            'post_type' => 'events',
			'orderby' => 'meta_value',
			'meta_key' => 'event_date',
			'meta_compare' => '>=',
			'meta_value' => $timecutoff,
			'order' => 'ASC',
            'posts_per_page' => 25,
            'tax_query' => array(
                array(
                    'taxonomy' => 'local-music',
                    'field' => 'id',
                    'terms' => array( $term_id ),
                )
            )
   	);
                $my_query = new WP_Query($args);
                if ($my_query->have_posts()) : while ($my_query->have_posts()) :
                    $my_query->the_post();
                  
    ?>
    <div class="TiqiqEventsList" href="<?php the_permalink() ?>"  >
                <div class="TiqiqEventRow">
                    <div class="TiqiqEventDate">
                        <strong>
                        	<br>
	                        	<a href="<?php the_permalink() ?>">
		                        	<span style="color:white;margin-top:-10px;">
			                    <?php
	                                $dateformatstring = "l,";
	                                $datebreak = "M j";
	                                $unixtimestamp = strtotime(get_field('event_date'));
	                                echo date_i18n($dateformatstring, $unixtimestamp);
		                        ?><br />
		                         <?php echo date_i18n($datebreak, $unixtimestamp); ?>
									</span>
								</a>
							</br>
				</strong>          
                    </div>
                    <div class="TiqiqEventName">
                       
                        <a href="<?php the_permalink() ?>" target="" title="">
                            <span class="TiqiqEventVenueNameText" style="padding-left:15px;color:white;"><b><?php the_field( "artists" ); ?></b>
                            	<br>
                            	 <?php
                                        $terms = get_the_terms( get_the_ID(), 'venue-name', '<span class="tags-title">' . __( '', 'bonestheme' ) . '</span> ', ', '  );
                                        if ( $terms && ! is_wp_error( $terms ) ) :
                                        $terms = array_values($terms);
                                    ?>
                                    <?php echo $terms[0]->name; ?>
                                    <?php endif; ?></b><br>

                                </span>
                        </a>
                    </div>
                    
                    <div class="TiqiqEventBuy">
                        <a href="<?php the_permalink() ?>" class="TiqiqEventBuyButton" title=""><strong>Tickets</strong></a>
                    </div>
                </div>                            
	</div>

              
            <?php endwhile;  ?>
                
<?php endif; ?>
<div class="block-top-artists">   

	<h2 class="title-headline">Hot Artists</h2>
       <?php
			$queried_object = get_queried_object();
            $term_id = $queried_object->term_id;
           
            $args = array(
                'post_type' => 'artists',
                'orderby'  => 'menu_order post_date',
                'taxonomy'  => 'local-music',
                'posts_per_page' => 5,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'local-music',
                        'field' => 'id',
                        'terms' => array( $term_id ),
                    )
                )
            );
                $my_query = new WP_Query($args);
                if ($my_query->have_posts()) : while ($my_query->have_posts()) :
                    $my_query->the_post();                  
                    ?>
                    <div class="related-posts-item clearfix">
	                     <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
	                            <?php the_post_thumbnail( 'col-4-img-thumb' ); ?>
	                     </a>
	                    <div class="single-title">
	                        <a href="<?php the_permalink() ?>"><h3><?php the_title(); ?><h3></a>
	                    </div>
	                </div>
            <?php endwhile;  ?>               
			<?php endif; ?>
			</div>

</div>

		</div>

	</div>


	<script src='https://api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.css' rel='stylesheet' />

	<?php if($location) : ?>
		<script>
			(function($) {
				$(function() {
					$.getJSON('http://api.songkick.com/api/3.0/events.json?location=geo:<?php echo $location; ?>&apikey=cCjyArjCh5IVzsyX&jsoncallback=?',
						function(data) {
							var events = data.resultsPage.results.event;
							events.sort(function(a, b) {
								if (a.popularity < b.popularity) {
									return 1;
								} else if (a.popularity > b.popularity) {
									return -1;
								} else {
									return 0;
								}
							});

							$.each(events/*.slice(0, 30)*/, function (i, event) {
								var artistsList = [];
								$.each(event.performance, function (j, performance) {
									artistsList.push(performance.artist.displayName);
								});

								var container = $('.concert-calendar tbody');
								var containerItem = $('<tr/>');
								var artist = $('<td/>').html(artistsList.join(', '));

								var date = moment(event.start.date, 'YYYY-MM-DD').format('MMMM Do');
								var dateWrapped = $('<td/>').html($('<span/>').html(date)).addClass('date');

								var ticketsLink = $('<a target="_blank"/>').attr('href', event.uri).attr('target', '_blank').html('Tickets');
								var ticketsLinkWrapped = $('<td/>').html(ticketsLink);

								containerItem.append(dateWrapped, artist, ticketsLinkWrapped);
								container.append(containerItem);
							});
						});
				});
			}(jQuery));
		</script>
	<?php endif; ?>

	<script>
		// var geocoder = L.mapbox.geocoder('examples.map-vyofok3q'),
		// 		map = L.mapbox.map('map', 'examples.map-vyofok3q'),
		// 		city = '<?php single_cat_title(); ?>';

		// geocoder.query(city, showMap);

		// function showMap(err, data) {
		// 	addMarkers(data);
		// 	map.fitBounds(data.lbounds);
		// }

		// function addMarkers(data) {
		// 	L.mapbox.featureLayer({
		// 			type: 'Feature',
		// 			geometry: {
		// 				type: 'Point',
		// 				coordinates: data.latlng
		// 			},
		// 			properties: {
		// 				title: city,
		// 				'marker-color': '#f86767'
		// 			}
		// 	}).addTo(map);
		// }
	</script>

<?php get_footer(); ?>
