<?php
/**
 * Page template
 */
?>
<link rel="stylesheet" href="http://zumic.com/wp-content/themes/zumic-backbone/library/css/style.css">
<style type="text/css">
#mc_embed_signup form {
  display: block;
  position: relative;
  text-align: left;
  padding: 0px 0 0px 3%!important;
}
#mc_embed_signup  {
height: auto!important;
  background-color: black;
}


#mc_embed_signup input.button {

  background-color: red!important;
}
input[type='text'] { width:  280px; }
input[type='email'] { width:  280px; }
textarea { width: 285px;}
#container {

  overflow: hidden;
  background: radial-gradient(black 15%, transparent 16%) 0 0, radial-gradient(black 15%, transparent 16%) 8px 8px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
  background-color: #282828;
  background-size: 16px 16px;

}
.block-newsletter-signup4 {
  background-image: url('/wp-content/themes/zumic-backbone/library/images/sidebarsubscribe.jpg');
  margin-bottom: 1em;
  width: 320px;
  height: 315px;
  display: inline-block;
  margin-left: -3px!important; 
}
</style>
<?php get_header(); ?>



			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="grid-8 first clearfix" role="main">
<div class="body-border2">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
							</section>

								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>

								</footer>

								<?php comments_template(); ?>

							</article>

							<?php endwhile; else : ?>

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

						</div>
</div>

						<div class="sidebar grid-4 last clearfix" role="complementary">
								<div class="new-ad" style="padding-left: 2px!important;">
							
									<script>
									/* sidebar-ad */
									cf_page_artist = "";
									cf_page_song = "";
									cf_adunit_id = "39383911";
									</script>
							</div>
							<br>
<div class="concertsb6">
            <h3></h3>
            <div class="zumic-a clearfix">
			     <a href="" target="_blank" style="width:310px;border:none;padding-left:12px;">
		            <img style="width:auto!important" src="http://zumic.com/wp-content/uploads/2015/03/zumic-logo-brushed-steel.png" >   
		        </a>
			     <div class="sidebar-geotitle">     
		          <hr style="margin-right:15px;margin-left:25px;height:.2%;"> 
		        </div>
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
							                <div class="single-title"><h3><?php the_title(); ?></h3></div>
							            </div>					   
						<?php 
							endwhile;
							wp_reset_postdata();
						?>
    			</div>
</div>
							<div class="block-newsletter-signup4 clearfix">
                                            <?php include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
                                        </div>

							
						

							<?php get_sidebar(); ?>

						
					</div>
				</div>

			</div>

<?php get_footer(); ?>
