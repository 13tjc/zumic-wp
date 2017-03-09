<?php 
/**
 * Disable image pages
 */
?>

<?php
	$attached = $post->post_parent;

	if( $attached == 0 ) {
		wp_redirect( get_bloginfo('url'), 307 );
		exit();
	} else {
		wp_redirect( get_permalink( $attached ), 301 );
		exit();
	}
