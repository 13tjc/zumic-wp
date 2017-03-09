<?php
/**
 * Power Rankings Template
 */
?>

<?php 
	$date_query = array(
			'after'     => '-7 days',
			'before'    => '+1 day',
			'inclusive' => true,
		);

	$filter = $_GET['show'];
	switch ($filter) {
		case '24h':
			$date_query = array(
				'after'     => '-24 hours',
				'before'    => '+1 day',
				'inclusive' => true,
			);
			break;

		case '1m':
			$date_query = array(
					'after'     => '-1 month',
					'before'    => '+1 day',
					'inclusive' => true,
				);
			break;

		case '1y':
			$date_query = array(
				'after'     => '-1 year',
				'before'    => '+1 day',
				'inclusive' => true,
			);
			break;

		case 'all':
			$date_query = array();
			break;

		default:
			break;
	}
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="grid-12 last clearfix" role="main">

								<header class="article-header titlebar">

									<h1 class="single-title title-headline"><?php the_title(); ?></h1>

									<div class="titlebar__filters">

										<form action="" method="GET">

											<select name="show" onchange="return this.form.submit()">

												<option value="">Last 7 Days</option>

												<option <?php if($filter === '24h') echo 'selected'; ?> value="24h">Last 24 hours</option>

												<option <?php if($filter === '1m') echo 'selected'; ?> value="1m">Last month</option>

												<option <?php if($filter === '1y') echo 'selected'; ?> value="1y">Last year</option>

												<option <?php if($filter === 'all') echo 'selected'; ?> value="all">All time</option>

											</select>

										</form>

									</div>

								</header>

								<section class="entry-content b-list grid-4 first clearfix">

									<h2 class="center">Video</h2>

									<?php 
										$args = array(
											'post_type' => array( 'post', 'music-videos' ),
											'posts_per_page' => 10,
											'tax_query' => array(
												array(
													'taxonomy' => 'media-type',
													'field' => 'slug',
													'terms' => 'video'
												)
											),
											'date_query' => array( $date_query ),
											'orderby' => 'menu_order',
											'order' => 'DESC'
										);

										$videos_query = new WP_Query( $args );
									?>

									<?php if ( $videos_query->have_posts() ) : ?>

										<!-- the loop -->
										<?php $i = 1; while ( $videos_query->have_posts() ) : $videos_query->the_post(); ?>

											<div class="b-list__item">
												<div class="b-list__header center">
													<a href="<?php the_permalink() ?>">
														<?php the_post_thumbnail( 'col-4-img-thumb-x' ); ?>
													</a>
												</div>

												<div class="b-list__title">
													<a href="<?php the_permalink() ?>">
														<div class="single-title"><h3><?php printf('%d. %s', $i, get_the_title() ); ?></h3></div>
													</a>
												</div>
											</div>

										<?php $i++; endwhile; ?><!-- end of the loop -->

										<?php wp_reset_postdata(); ?>

									<?php else:  ?>
										<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
									<?php endif; ?>

								</section>

								<section class="entry-content b-list grid-4 clearfix">

									<h2 class="center">Audio</h2>

									<?php 
										$args = array(
											'post_type' => array( 'post', 'music-videos' ),
											'posts_per_page' => 10,
											'tax_query' => array(
												array(
													'taxonomy' => 'media-type',
													'field' => 'slug',
													'terms' => 'full-album-stream'
												)
											),
											'date_query' => array( $date_query ),
											'orderby' => 'menu_order',
											'order' => 'DESC'
										);
										$audio_query = new WP_Query( $args );
									?>

									<?php if ( $audio_query->have_posts() ) : ?>

										<!-- the loop -->
										<?php $i = 1; while ( $audio_query->have_posts() ) : $audio_query->the_post(); ?>

											<div class="b-list__item">
												<div class="b-list__header center">
													<a href="<?php the_permalink() ?>">
														<?php the_post_thumbnail( 'col-4-img-thumb-x' ); ?>
													</a>
												</div>

												<div class="b-list__title">
													<a href="<?php the_permalink() ?>">
														<div class="single-title"><h3><?php printf('%d. %s', $i, get_the_title() ); ?></h3></div>
													</a>
												</div>
											</div>

										<?php $i++; endwhile; ?><!-- end of the loop -->

										<?php wp_reset_postdata(); ?>

									<?php else:  ?>
										<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
									<?php endif; ?>

								</section>

								<section class="entry-content b-list grid-4 last clearfix">

									<h2 class="center">News</h2>

									<?php 
										$args = array(
											'post_type' => array( 'post' ),
											'posts_per_page' => 10,
											'date_query' => array( $date_query ),
											'orderby' => 'menu_order',
											'order' => 'DESC'
										);
										$news_query = new WP_Query( $args );
									?>

									<?php if ( $news_query->have_posts() ) : ?>

										<!-- the loop -->
										<?php $i = 1; while ( $news_query->have_posts() ) : $news_query->the_post(); ?>

											<div class="b-list__item">
												<div class="b-list__header center">
													<a href="<?php the_permalink() ?>">
														<?php the_post_thumbnail( 'col-4-img-thumb-x' ); ?>
													</a>
												</div>

												<div class="b-list__title">
													<a href="<?php the_permalink() ?>">
														<div class="single-title"><h3><?php printf('%d. %s', $i, get_the_title() ); ?></h3></div>
													</a>
												</div>
											</div>

										<?php $i++; endwhile; ?><!-- end of the loop -->

										<?php wp_reset_postdata(); ?>

									<?php else:  ?>
										<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
									<?php endif; ?>

								</section>

								<?php // comments_template(); ?>

						</div>

						<div class="sidebar grid-12 last clearfix" role="complementary">

							<?php get_sidebar(); ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
