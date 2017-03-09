<?php
/**
* Media types taxonomy page
*/
?>
<?php get_header(); ?>
<link rel="stylesheet" href="http://zumic.com/wp-content/themes/zumic-backbone/library/css/style.css">
<style type="text/css">
#container {
  overflow: hidden;
  background: radial-gradient(black 15%, transparent 16%) 0 0, radial-gradient(black 15%, transparent 16%) 8px 8px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
  background-color: #282828;
  background-size: 16px 16px;
}
.body-border2 {color: white;background-color: #191919;border: 1px solid; border-color: black black black;width: 100%;
  max-width: 750px;padding: 2.6041667%;float: left;
  border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;
  border-top: 1px solid black;border-radius: 5px;
  margin-bottom: 10px;padding-right: 8px;padding-left: 12px;background-image: none;
}
.body-border2 h2 a{color: white;}
.body-border2 h2 a:hover{color: white;}
.body-border2:hover{color: white;}
.title-headline {border-bottom: 4px solid #979797;}
.collapsible-body {padding: 8px 12px;background-color: #272822;}
.collapsible-hndle {background-color: #333;}
</style>
	<div id="content">
		<div id="inner-content" class="wrap clearfix">
				<div class="sidebar grid-4 first clearfix" role="complementary">
					<div class="body-border2" stlye="background-color:black!important;">
					<?php
					$image_url = apply_filters( 
						'taxonomy-images-queried-term-image-url', 
						'', 
						array( 'image_size' => 'col-4-img-thumb-x' ) 
					);
					printf( '<img src="%s" />', $image_url );
					?>
					<div class="media-type collapsible-row">
						<h2 class="title-headline">Media types</h2>
						<?php
						$args = array(
							'taxonomy' => 'media-type',
							'orderby' => 'name',
							'echo' => 0
							);
						$cats = get_categories( $args );
						$cats_sorted = array();
						sort_terms_hierarchicaly( $cats, $cats_sorted );

						foreach( $cats_sorted as $key => $category ) :
						?>
							<div class="collapsible-wrapper">
								<div class="collapsible-handlediv" title="Click to toggle"></div>
								<div class="collapsible-hndle">
									<?php 
									printf('<a href="/media-type/%s">%s</a>',
										$category->slug,
										$category->name 
									);
									?>
								</div>
								<div class="collapsible-body">
									<ul class="sub-categories">
										<?php 
										if( $category->children ) {
											foreach( $category->children as $sub_key => $sub_category ) {
												printf('<li><a href="/media-type/%s">%s</a></li>',
													$sub_category->slug,
													$sub_category->name 
												);
											}
										} else {
											printf('Sorry, check the root Media type!');
										}
										?>
									</ul>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php get_sidebar(); ?>
	     			<div class="zumic-a">
						<?php echo get_adsense( get_the_ID(), '8828835930', '300x600' ); ?>
					</div>
				</div>
			</div>
				<div id="main" class="grid-8 last clearfix" role="main">
					<div class="body-border2">
							<?php
							$queried_object = get_queried_object();
							$term_id = $queried_object->term_id;
							$args = array(
								'post_type' => array( 'post', 'music-videos' ),
								'posts_per_page' => 10,
								'paged' => get_query_var('paged'),
								'tax_query' => array(
									array(
										'taxonomy' => 'media-type',
										'field' => 'id',
										'terms' => array( $term_id ),
									)
								)
							);
							query_posts($args);
							?>
							<h1 class="title-headline"><?php single_cat_title(); ?></h1>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix articles-list' ); ?> role="article">
								<header class="article-header">
									<h2 class=""><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<p class="byline vcard"><?php
										printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'bonestheme' )), bones_get_the_author_posts_link());
									?></p>
								</header>
								<section class="entry-content clearfix">
									<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
										<?php the_post_thumbnail( 'related-thumb' ); ?>
									</a>
									<div class="excerpt">
										<?php the_excerpt(); ?><br>
										<div class="fb-like" data-href="<?php echo get_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share=""></div>
												<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
												<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
												<div class="g-plus" data-action="share" data-annotation="bubble"></div>
												<script type="text/javascript">
												  (function() {
												    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
												    po.src = 'https://apis.google.com/js/platform.js';
												    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
												  })();
												</script>
									</div>
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
					</div>
				</div>
		</div>
	</div>
<?php get_footer(); ?>
