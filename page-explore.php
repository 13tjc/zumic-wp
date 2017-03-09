<?php
/**
 * Explore page 
 */
?>
<style type="text/css">
#container {
  overflow: hidden;
  background: radial-gradient(black 15%, transparent 16%) 0 0, radial-gradient(black 15%, transparent 16%) 8px 8px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px, radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
  background-color: #282828;
  background-size: 16px 16px;
}
</style>
<?php get_header(); ?>

		<div id="content" class="container">

			<div id="inner-content" class="wrap clearfix">

					<div id="main" class="clearfix" role="main">
						<div class="block-trending block-artists clearfix">
							<a href="http://zumic.com/artists"><h2 class="titletxt">Trending Artists</h2></a>
							<?php include(TEMPLATEPATH."/parts/featured-artists.php"); ?>
						</div>
						<div class="block-trending block-albums-lp clearfix">
							<a href="http://zumic.com/music-videos/media-type/audio/full-album-stream/"><h2 class="titletxt">Albums</h2></a>
							<?php include(TEMPLATEPATH."/parts/featured-albums-lp.php"); ?>
						</div>
						<div class="block-trending block-concert-announcements clearfix">
							<a href="http://zumic.com/concert-announcements"><h2 class="titletxt">Concert & Tour Announcements</h2></a>
							<?php include(TEMPLATEPATH."/parts/featured-concert-announcements.php"); ?>
						</div>
						<div class="block-trending block-news clearfix">
							<a href="http://zumic.com/music-videos/media-type/live-performance-video/"><h2 class="titletxt">Live Music</h2></a>
							<?php include(TEMPLATEPATH."/parts/featured-live-music.php"); ?>
						</div>
						<div class="block-trending block-news clearfix">
							<a href="http://zumic.com/media-type/official-music-video/"><h2 class="titletxt">Official Music Videos</h2></a>
							<?php include(TEMPLATEPATH."/parts/featured-official-music-video.php"); ?>
						</div>
						<div class="block-trending block-singles clearfix">
							<a href="http://zumic.com/media-type/audio-single/"><h2 class="titletxt">Audio Singles</h2></a>
							<?php include(TEMPLATEPATH."/parts/featured-singles.php"); ?>
						</div>
						<div class="block-trending block-albums-ep clearfix">
							<a href="http://zumic.com/media-type/free-download/"><h2 class="titletxt">Mix Tapes, EPs, and Free Downloads</h2></a>
							<?php include(TEMPLATEPATH."/parts/featured-albums-ep.php"); ?>
						</div>
						<div class="block-trending block-news clearfix">
							<a href="http://zumic.com/news"><h2 class="titletxt">News</h2></a>
							<?php include(TEMPLATEPATH."/parts/featured-news.php"); ?>
						</div>
						<div class="block-trending block-news clearfix">
							<a href="http://zumic.com/features/"><h2 class="titletxt">Features</h2></a>
							<?php include(TEMPLATEPATH."/parts/featured-features.php"); ?>
						</div>			

						<!-- 					
						<div class="block-trending block-videos clearfix">
						<h2>Trending Videos:</h2>
						<?php //include(TEMPLATEPATH."/parts/featured-videos.php"); ?>
						</div>
						 -->

					</div>

					<?php // get_sidebar(); ?>

					<div class="zumic-a clearfix">
						<?php echo get_responsive_adsense( get_the_ID(), '4683217536' ); ?>
					</div>

			</div>

		</div>

<?php get_footer(); ?>
