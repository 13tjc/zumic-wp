<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<?php
		header("Expires: Tue, 01 Jan 2014 00:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		 ?>
		<script>
		ga('create', 'UA-35247962-1');
		ga('require', 'linkid', 'linkid.js');
		ga('send', 'pageview');
			WebFontConfig = {
			  google: { families: ['FontOne', 'FontTwo'] },
			    fontinactive: function (fontFamily, fontDescription) {
			   //Something went wrong! Let's load our local fonts.
			    WebFontConfig = {
			      custom: { families: ['FontOne', 'FontTwo'],
			      urls: ['font-one.css', 'font-two.css']
			    }
			  };
			  loadFonts();
			  }
			};
			function loadFonts() {
			  var wf = document.createElement('script');
			  wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
			    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			  wf.type = 'text/javascript';
			  wf.async = 'true';
			  var s = document.getElementsByTagName('script')[0];
			  s.parentNode.insertBefore(wf, s);
			}
			(function () {
			  //Once document is ready, load the fonts.
			  loadFonts();
			  })();
	</script>
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		<!-- <link rel="stylesheet" href="
<?php 
//bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css?v=1.2');
?>
" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/library/css/style.css"> -->
		<link rel="stylesheet" href="http://zumic.com/wp-content/themes/zumic-backbone/library/css/style.css">
		<base href="/">
		<meta charset="utf-8">
		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="google-site-verification" content="WhXM0jWXC3fey9RgDB_4IYMMDvO20b1NS44ndM-wrJc" />
		<title><?php wp_title(''); ?></title>
		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#000000">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
		<meta property="fb:app_id" content="421078361357832" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=5"> -->
		<meta http-equiv="X-UA-Compatible" content="IE=8">
		<?php if (strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 8")) {
			header("X-UA-Compatible: IE=10");} ?>
			<?php if (strpos($_SERVER['HTTP_USER_AGENT'],"MSIE 9")) {
			header("X-UA-Compatible: IE=10");} ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>
		<?php // drop Google Analytics Here ?>
		<script>(function() {
 var _fbq = window._fbq || (window._fbq = []);
 if (!_fbq.loaded) {
   var fbds = document.createElement('script');
   fbds.async = true;
   fbds.src = '//connect.facebook.net/en_US/fbds.js';
   var s = document.getElementsByTagName('script')[0];
   s.parentNode.insertBefore(fbds, s);
   _fbq.loaded = true;
 }
 _fbq.push(['addPixelId', '795984600437518']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=795984600437518&amp;ev=PixelInitialized" /></noscript>
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-35247962-1', 'zumic.com');
	ga('require', 'displayfeatures');
	ga('send', 'pageview');
	</script>
<?php // end analytics ?>
	 <!-- Begin comScore Tag -->
	<script>
	 var _comscore = _comscore || [];
	 _comscore.push({ c1: "2", c2: "19015585" });
	 (function() {
	   var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
	   s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
	   el.parentNode.insertBefore(s, el);
	 })();
	</script>
	<style>.block-related.clearfix.sidebar { display: none!important;}</style>
	<noscript>
	 <img src="http://b.scorecardresearch.com/p?c1=2&c2=19015585&cv=2.0&cj=1" />
	</noscript>
	<!-- End comScore Tag -->
</head>

	<body <?php body_class(); ?>>
		<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		<div id="container">
			<header class="header sticky-header" role="banner">
				<div id="inner-header" class="wrap clearfix">
					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
					<div class="logo grid-3 clearfix">
						<a href="http://zumic.com/?show=" rel="nofollow"><?php //bloginfo('name'); ?><img src="/wp-content/themes/zumic/images/zumic_logo_respon.png" alt="Zumic"></a>
					</div>
					<div class="logorespon">
						<a href="http://zumic.com/?show=" rel="nofollow"><?php //bloginfo('name'); ?><img style="border:none;" src="../wp-content/themes/zumic/images/zumic_logo_respon.png" alt="Zumic"></a>
					</div>
						<div class="rmenubar">
						<label for="show-menu" class="show-menu"><img style="border:none;" src="/wp-content/themes/zumic-backbone/library/images/rmenu2.png" ></label>
						</div>
						<div class="rmenu">
						<input type="checkbox" id="show-menu" role="button">
							<ul id="menu">
								<li style="padding-top:5px;padding-bottom:5px;border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#333;height:45px;">
									<?php get_search_form(); ?>
								</li>
								<li style="border-bottom-style:solid;border-bottom-width:8px;border-bottom-color:#333;">
									<a href="http://zumic.com/local-concert-listings/" ><strong style="color:#ddd!important;">LOCAL CONCERTS</strong></a>
								</li>
								<li>
									<a href="#"><strong style="color:#ddd!important;">WHAT'S HOT</strong></a>
									<ul class="hidden">
										<li><a href="?show=">All Posts</a></li>
										<li><a href="?show=video">Videos</a></li>
										<li><a href="?show=audio">Singles</a></li>
										<li><a href="?show=albums">Albums</a></li>
									</ul> 
								</li>
								<li>
									<a href="#"><strong style="color:#ddd!important;">LATEST</strong></a>
									<ul class="hidden">
										<li><a href="?show=latest">All Posts</a></li>
										<li><a href="?show=videol">Videos</a></li>
										<li><a href="?show=audiol">Singles</a></li>
										<li><a href="?show=albumsl">Albums</a></li>
									</ul> 
								</li>
							
								<li>
									<a href="#"><strong style="color:#ddd!important;">BEST OF MONTH</strong></a>
									<ul class="hidden">
										<li><a href="?show=bestofmonth">All Posts</a></li>
										<li><a href="?show=videob">Videos</a></li>
										<li><a href="?show=audiob">Singles</a></li>
										<li><a href="?show=albumsb">Albums</a></li>
									</ul>  
								</li>
								<li>
									<a href="#"><strong style="color:#ddd!important;">BEST OF YEAR</strong></a>
									<ul class="hidden">
										<li><a href="?show=bestofyear">All Posts</a></li>
										<li><a href="?show=videoby">Videos</a></li>
										<li><a href="?show=audioby">Singles</a></li>
										<li><a href="?show=albumsby">Albums</a></li>
									</ul>  
								</li>
							</ul>
						</div>
					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>
					<div class="header-navigation grid-9 last">
						<nav role="navigation" class="nav main-nav grid-8">
							<?php bones_main_nav(); ?>
						</nav>
							<div class="container-so">
						        <ul>
						            <li>
						            	<a href="https://twitter.com/Zumic" target="_blank">
					                		<img src="/wp-content/themes/zumic-backbone/library/images/t24.png" > 
					            		</a>
					            	</li>
						            <li>
						            	<a href="https://www.facebook.com/zumicnews" target="_blank">
					               			<img src="/wp-content/themes/zumic-backbone/library/images/24.png" >
					            		</a>
						            </li>
						            <li>
						            	<?php get_search_form(); ?>
						            </li>
						        </ul>
						        <div style="clear: both;">
						        </div>
						    </div>
					</div>
				</div>
			</header>
