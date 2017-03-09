<?php 
/**
 * Author page template
 */
?>

<?php
		$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
		$author_id = $curauth->ID;

		if( !in_array( 'edit_posts', $curauth->allcaps ) ) {
			header("HTTP/1.0 404 Not Found - Page doesn't exist");
			$wp_query->set_404();
			include( TEMPLATEPATH . '/404.php' );
			exit;
		}

	 $filter = $_GET['show'];
		$args = array(
			'post_type' => array( 'post', 'music-videos' ),
			'author' => $author_id,
			'posts_per_page' => 10,
			'paged' => get_query_var('paged')
		);
		 switch ( $filter ) {
                case 'latest':
                        $orderby = 'post_date DESC';           
                        $args[ 'orderby' ] = 'post_date';
                break;
                default:
                        $args[ 'orderby' ] = 'menu_order post_date';
                break;
        }

		query_posts($args);
?>

<?php get_header(); ?>
<style type="text/css">
h2 a {color: white;}
.title-headline {border-bottom: 4px solid #f12749;}
span.author a {color: #78c0eb;}
#container {
  overflow: hidden;
  background: radial-gradient(black 15%, transparent 16%) 0 0, radial-gradient(black 15%, transparent 16%) 8px 8px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
  background-color: #282828;
  background-size: 16px 16px;
}
.body-border2 {
  color: white;
  background-color: #191919;
  border: 1px solid;
  border-color: black black black;
  width: 100%;
  max-width: 750px;
  padding: 2.6041667%;
  float: left;
  border-left: 1px solid black;
  border-right: 1px solid black;
  border-bottom: 1px solid black;
  border-top: 1px solid black;
  border-radius: 5px;
  margin-bottom: 10px;
  padding-right: 8px;
  padding-left: 12px;
  background-image: none;
}
.body-border2 h2 a{color: white;}
.body-border2 h2 a:hover{color: white;}
.body-border2:hover{color: white;}
.poptop{content: "<br>";margin-left: 25px!important;}
a {color: #78c0eb;text-decoration: none;font-weight: 500;} 
a:visited {color: #00a8e2;}
.title-headline {border-bottom: 4px solid #78c0eb;}
</style>
	<div id="content">

		<div id="inner-content" class="wrap clearfix">

				<div id="main" class="grid-8 clearfix" role="main">


					<div class="body-border2">




					<div class="titlebar">
						<h1 class="title-headline"> Posts By <?= get_the_author_meta( 'display_name' ); ?></h1>

						<div class="titlebar__filters">
							<form action="" method="GET">
								<select name="show" onchange="return this.form.submit()">
									<option value="">Top Rated</option>
									<option <?php if($filter === 'latest') echo 'selected'; ?> value="latest">Latest</option>
									
								</select>
							</form>
						</div>
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

							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
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

				<div class="sidebar grid-4 last">
<div class="body-border2">
					<?php if ( have_posts() && is_author() ) : ?>

						<h1 class=""><?= get_the_author_meta( 'display_name' ); ?></h1>


						<div itemscope itemtype="http://schema.org/Person" id="item-header" >
							<div id="item-header-avatar">
								<a href="<?= get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="Posts by <?= get_the_author_meta( 'display_name' ); ?>"><?= get_avatar( get_the_author_meta( 'ID' ), 92 ); ?></a>
							</div>

							<?php $a_twitter = get_the_author_meta( 'twitter' ); ?>
							<?php $a_facebook = get_the_author_meta( 'facebook' ); ?>

							<?php if(get_the_author_meta('twitter') ): ?>
						  <a href="https://twitter.com/<?= get_the_author_meta( 'twitter' ); ?>" target="_blank">
								<img style="border:none;"src="/wp-content/themes/zumic-backbone/library/images/t24.png">
							</a>
						<?php else: ?>
						  <?php echo ""; ?>
						<?php endif; ?>
						<?php if(get_the_author_meta('facebook') ): ?>
						 <a href="https://facebook.com/<?= get_the_author_meta( 'facebook' ); ?>" target="_blank">
						 		<img style="border:none;" src="/wp-content/themes/zumic-backbone/library/images/24.png">
						 	</a> 
						<?php else: ?>
						  <?php echo ""; ?>
						<?php endif; ?>



						<!-- 	<a href="https://twitter.com/<?= get_the_author_meta( 'twitter' ); ?>" target="_blank">
								<img style="border:none;"src="/wp-content/themes/zumic-backbone/library/images/t24.png">
							</a>

						 	<a href="https://facebook.com/<?= get_the_author_meta( 'facebook' ); ?>" target="_blank">
						 		<img style="border:none;" src="/wp-content/themes/zumic-backbone/library/images/24.png">
						 	</a>  -->

								



							
							

							<div id="item-header-content">

								<div itemprop="jobTitle"><?= get_the_author_meta( 'description' ) ?></div>

								<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
									<span itemprop="streetAddress"></span>
									<span itemprop="addressLocality"></span>
									<span itemprop="addressRegion"></span>
									<span itemprop="postalCode"></span>
								</div>
								<span itemprop="telephone"></span>
								<a href="mailto:" itemprop="email"></a>
							</div>
							<div class="clearfix"></div>
						</div>

						
							<h1 class="title-headline">Favorite music genres</h1>
							<div class="widget author-popular">
								<div class="poptop">
							<?php 
								$popular_genres = get_author_popular_topics( $author_id, 'music-genres', 5 ); 
								$args = array(
									'smallest'  => 1.1,
									'largest'   => 1.1,
									'unit'      => 'em', 
									'style' =>    'list',
									// 'order'     => 'RAND' 
								);
								echo wp_generate_tag_cloud_custom( $popular_genres, $args); 
							?>
						</div>
						 
						</div>

						<h1 class="title-headline">Favorite artists</h1>
						<div class="widget author-popular">
							<div class="poptop">
								<?php 
									$popular_artists = get_author_popular_topics( $author_id, 'post_tag', 5 );
									$args = array(
										'smallest'  => 1.1,
										'largest'   => 1.1,
										'unit'      => 'em', 
										// 'order'     => 'RAND' 
									);
									echo wp_generate_tag_cloud_custom( $popular_artists, $args, '<br />'); 
								?>
							</div>
						</div>		

						<?php
							$author_twitter = get_the_author_meta( 'twitter' );
							$author_twitter_link = '';
							if($author_twitter) {
								$author_twitter_link = sprintf( '<a href="https://twitter.com/%s" target="_blank"><img src="/wp-content/themes/zumic-backbone/library/images/t24.png"></a>', $author_twitter );
							}else{
								echo "";
							}

						?>

					<?php endif; ?>
					<br>

					<div class="zumic-a">
								<?php echo get_adsense( get_the_ID(), '8828835930', '300x600' ); ?>
							</div>

					<?php get_sidebar(); ?>

				</div>
</div>
		</div>

	</div>

<?php get_footer(); ?>
