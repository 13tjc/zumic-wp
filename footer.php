			<footer class="footer" role="contentinfo">
				<div class="footer-pre">
					<div class="footer-pre-inner wrap">
						<span>CONNECT:</span>
						<a href="https://twitter.com/Zumic" target="_blank"><img src="http://zumic.com/wp-content/uploads/2015/02/twitter-icon-footer.png"></a>
						<a href="https://www.facebook.com/zumicnews" target="_blank"><img src="http://zumic.com/wp-content/uploads/2015/02/facebook-icon-footer.png"></a>
						<a href="https://plus.google.com/+zumic" target="_blank"><img src="http://zumic.com/wp-content/uploads/2015/02/google-plus-footer.png"></a>
						<a href="http://instagram.com/zumicnews" target="_blank"><img src="http://zumic.com/wp-content/uploads/2015/02/1instagram-icon-footer.png"></a>
						<a href="https://www.youtube.com/user/ZumicTube" target="_blank"><img src="http://zumic.com/wp-content/uploads/2015/02/1youtube-icon-footer.png"></a>
						<a href="/feed/" target="_blank"><img src="http://zumic.com/wp-content/uploads/2015/02/1rss-icon-footer.png"></a>
					</div>
				</div>
				<div class="footer-main wrap clearfix">
					<?php echo apply_filters( 'the_content', get_post_field( 'post_content', 62893 ) ); ?>
					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> Zumic Entertainment, Inc. All rights reserved.</p>
				</div>
<script src="https://www.dwin2.com/pub.200107.min.js"></script>
			</footer>
		</div>
		<?php // all js scripts are loaded in library/bones.php ?>
		<script type="text/javascript" charset="utf-8">
		 jQuery(function() { jQuery('body').hide().show(); });
		  jQuery(window).bind("load", function(){ jQuery(window).resize(); });  
		</script>
	</body>
<?php wp_footer(); ?>
</html>
