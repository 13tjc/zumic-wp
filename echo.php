<?
echo get_post_field('menu_order', $post->ID);


$my_post = array('ID'=>37, 'menu_order' =>30); wp_update_post( $my_post)

wp_schedule_event()







add_action( 'wp', 'prefix_setup_schedule' );
/**
 * On an early action hook, check if the hook is scheduled - if not, schedule it.
 */
function prefix_setup_schedule() {
	if ( ! wp_next_scheduled( 'prefix_daily_event' ) ) {
		wp_schedule_event( time(), 'daily', 'prefix_daily_event');
	}
}


add_action( 'prefix_daily_event', 'prefix_do_this_daily' );
/**
 * On the scheduled action hook, run a function.
 */
function t_minus_ten() {
	// do something every hour
}
?>




<?php
							add_action( 'wp', 'prefix_setup_schedule' );
							add_filter( 'posts_orderby', 'order_by_multiple' );

							$args = array(
								'post_type' => array( 'post' ), 
								'post_status' => 'publish', 
								'posts_per_page' => 10
								
							);


							query_posts( $args );

							remove_filter( 'posts_orderby', 'order_by_multiple' );
							function prefix_setup_schedule() {
								if ( ! wp_next_scheduled( 'prefix_daily_event' ) ) {
									wp_schedule_event( time(), 'daily', 'prefix_daily_event');
								}
							}


							add_action( 'prefix_daily_event', 'prefix_do_this_daily' );
							/**
							 * On the scheduled action hook, run a function.
							 */
							function t_minus_ten() {
								$number = $args; 
								$tenminus = 10; 
								$newnumber = $number * (1 - $tenminus); 
								echo $newnumber;  



						?>

<?php wp_schedule_event($timestamp, $recurrence, $hook, $args); ?> 

