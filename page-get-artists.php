<?php
    global $wpdb;
    // echo 'hi';
    $artists = $wpdb->get_results(
        "SELECT post_title, menu_order FROM wp_posts
         WHERE post_type='artists'
         ORDER BY menu_order DESC"
    );

    $out = "post_title,menu_order\n";

    foreach ($artists as $artist) {
        // echo $artist.'<br>';
        $title = $artist->post_title;
        $order = $artist->menu_order;
        $out = $out.$title.",".$order."\n";
    }

    echo $out;
?>