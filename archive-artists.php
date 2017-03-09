<?php get_header(); ?>
<link rel="stylesheet" href="http://zumic.com/wp-content/themes/zumic-backbone/library/css/style.css">
<style>
h1, .h1 {
 
  color: white;
}
.single-title {
  color: white;
 
}
.wrap .grid-4 {
  width: 98%;
  color: white;
}

#container {
  overflow: hidden;
  background: radial-gradient(black 15%, transparent 16%) 0 0, radial-gradient(black 15%, transparent 16%) 8px 8px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
  background-color: #282828;
  background-size: 16px 16px;
}
@media only screen and (min-device-width: 480px) { 
.wrap .grid-4 {
width: 31.62393%;
float: left;
margin-right: 2.5641%;
display: inline;
}

h1.archive-title {color: white;}
.single-title {color: white;margin-bottom: -10px;}}
</style>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="eightcol first clearfix" role="main">

							<h1 class="archive-title"><?php post_type_archive_title(); ?></h1>

							<?php

								add_filter( 'posts_orderby', 'order_by_multiple' );

								$args = array(
									'post_type' => array( 'artists' ), 
									'post_status' => 'publish', 
									'posts_per_page' => 30,
									'paged' => get_query_var('paged')
								);

								query_posts( $args );

								remove_filter( 'posts_orderby', 'order_by_multiple' );
							?>

							<?php if (have_posts()) : $i = 1; while (have_posts()) : the_post(); ?>

								<div class="grid-4<?php if($i%3 === 0) echo ' last'; ?> entry-content">

									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail( 'col-4-img-thumb-c' ); ?>
										<div class="single-title"><?php echo $found_posts; ?><h3><?php the_title(); ?></h3></div>
									</a>

								</div>

							<?php $i++; endwhile; ?>

									

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

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
