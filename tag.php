<?php
/**
* Music genres taxonomy page
*/
?>
<style>
.body-border2 {color: white;background-color: #191919;border: 1px solid;border-color: black black black;
  width: 100%;max-width: 750px;padding: 2.6041667%;float: left;border-left: 1px solid black;
  border-right:1px solid black;border-bottom: 1px solid black;border-top: 1px solid black;border-radius: 5px;
  margin-bottom:10px;padding-right:8px;padding-left: 12px;background-image: none;}
.body-border2 h2 a{color: white;}
.search-results-item.clearfix:hover{background-color: #191919!important;}
.title-headline { border-bottom: 4px solid #979797; }
p:hover{color: white;}
.wrap .grid-8.last { width: auto!important;}

</style>
<?php get_header(); ?>
	<div id="content">
		<div id="inner-content" class="wrap clearfix">
			<div class="sidebar grid-4 first clearfix" role="complementary">
				<div class="body-border2" style="margin-top:-10px">
					<div class="widget popular-tags" style="padding-left:20px;">
						<h2 class="title-headline">Popular tags</h2>
						<?php 
							$args = array(
								'smallest'  => 0.9,
								'largest'   => 1.7,
								'unit'      => 'em', 
								'number'    => 75,
								// 'order'     => 'RAND' 
							);
							if ( function_exists('wp_tag_cloud') ) {
								wp_tag_cloud( $args );  
							}
						?>
					</div>
				</div>
					<?php get_sidebar(); ?>
				</div>
<div class="body-border2">
				<div id="main" class="grid-8 last clearfix" role="main">
					<?php
					$queried_object = get_queried_object();
					$term_id = $queried_object->term_id;

					$args = array(
						'post_type' => array( 'post', 'music-videos' ),
						'posts_per_page' => 10,
						'paged' => get_query_var('paged'),
						'tax_query' => array(
							array(
								'taxonomy' => 'post_tag',
								'field' => 'id',
								'terms' => array( $term_id )
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

							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail( 'related-thumb' ); ?>
							</a>
							
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
