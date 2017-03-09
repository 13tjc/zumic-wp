<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

				<div id="main" class="grid-8 first clearfix" role="main">
					<div class="body-border">
							

							<?php if (is_category()) { ?>
								<h1 class="title-headline">
									<span><?php _e( '', 'bonestheme' ); ?></span> <?php single_cat_title(); ?>
								</h1>

							<?php } elseif (is_tag()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
								</h1>

											<?php } elseif (is_author()) {
												global $post;
												$author_id = $post->post_author;
											?>
												<h1 class="archive-title h2">

													<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

												</h1>
											<?php } elseif (is_day()) { ?>
												<h1 class="archive-title h2">
													<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
												</h1>

											<?php } elseif (is_month()) { ?>
													<h1 class="archive-title h2">
														<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
													</h1>

											<?php } elseif (is_year()) { ?>
													<h1 class="archive-title h2">
														<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
													</h1>
											<?php }else{ ?>
											<h1 class="title-headline">
												<span>Zumic Music Video Archives</span> 
											</h1>

												<?php } ?>


							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix articles-list' ); ?> role="article">

								<header class="article-header">

									<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline vcard"><?php
										printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'bonestheme' )), bones_get_the_author_posts_link(), get_the_category_list(', '));
									?></p>

								</header>

								<section class="entry-content clearfix">

									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php the_post_thumbnail( 'related-thumb' );?>
									</a>


									<div class="excerpt">
										<?php the_excerpt(); ?>
									</div>

								</section>

								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; ?>

									<?php if ( function_exists( 'bones_page_navi' ) ) { ?>
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
							<div class="sidebar grid-4 last clearfix" role="complementary">

										<div class="zumic-a clearfix">
											<?php echo get_adsense( get_the_ID(), '4342284338', '300x250' ); ?>
										</div>

										<?php 
											$post_tags = wp_get_post_terms( 
												get_the_ID(), 
												'post_tag', 
												['fields' => 'slugs'] 
											);
											$related_artists = get_artists_by_slug( $post_tags );
											if( $related_artists ):
										?>
											<!-- <div class="block-related-artists">
												<h2 class="title-headline">Related Artists</h2>
												<?php 
													foreach( $related_artists as $key => $artist ): 
												?>
													<div class="related-posts-item clearfix">
														<div class="img-wrapper">
															<?php printf( "<a href='/artists/%s'>%s</a>", $artist->post_name, get_the_post_thumbnail( $artist->ID, 'col-4-img-thumb' ) ); ?>
														</div>
														<div class="single-title">
															<?php printf( "<a href='%s' title='%s'><h3>%s</h3></a>", $artist->post_name, $artist->post_title, $artist->post_title ); ?>
														</div>
													</div>
												<?php endforeach; ?>
											</div> -->
										<?php endif; ?>

									<!-- <div class="block-related-music clearfix">
											<h2 class="title-headline">Related Music</h2>
											<?php //echo show_related_posts(['music-videos'], 4, 'sm-thumb'); ?>
										</div>  -->
										<div class="block-newsletter-signup clearfix">
											<?php include( TEMPLATEPATH."/parts/mailchimp-signup-form.php" ); ?>
										</div>

										<div class="zumic-a clearfix">
											<?php include( TEMPLATEPATH . "/parts/fb-likebox.php" ); ?>
										</div>

										<div class="zumic-a clearfix">
											<?php include( TEMPLATEPATH . "/parts/tw-widget.php" ); ?>
										</div>

										<!-- <div class="zumic-a clearfix">
											<?php echo get_adsense( get_the_ID(), '5030870732', '300x250' ); ?>
										</div> -->

										<?php get_sidebar(); ?>
										
							<div class="zumic-a">
								<?php echo get_adsense( get_the_ID(), '8828835930', '300x600' ); ?>
							</div>

									</div>

					

						

				</div>

				

			</div>

<?php get_footer(); ?>
