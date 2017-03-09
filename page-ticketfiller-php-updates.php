<!--Updated 2014/12/09 16:33 by David Su-->
<title>Template for Ticketfiller PHP Updates and Manual Updates</title>

<style>
  success {
    color: blue;
    font-weight: bold;
  }

  noupdate {
    color: blue;
  }

  failure {
    color: red;
    font-weight: bold;
  }

</style>
<script>
    console.log("ola!");

</script>

<!--initial setup and test-->
<?php

//setup
global $wpdb;

function update_database($value, $id, $key) {
  global $wpdb;
  //echo $value.$id.$key;
  $wpdb_result = $wpdb->update(
    $wpdb->postmeta,
    array(
      'meta_value' => $value
      ),
    array(
      'post_id' => $id,
      'meta_key' => $key
      )
    );
  //echo $wpdb_result;
  $scenario = '<failure>?? </failure>';
  if (0 < $wpdb_result) {
    $scenario = '<success>SUCCESS:</success> ';
  }
  else if (0 === $wpdb_result) {
    $scenario = '<noupdate>SUCCESS (but no update):</noupdate> ';
  }
  else if (false === $wpdb_result) {
    $scenario = '<failure>FAILURE:</failure> ';
  }
  echo $scenario.$wpdb->last_query.'<br><br>';

}

function post_id_by_title($title) {
  global $wpdb;
  $exists = $wpdb->get_row( 'SELECT ID FROM wp_posts WHERE post_title LIKE "' . $title . '%%"');

  if ($exists == null) {
    return -1;
  }
  else {
    return $exists->ID;
  }
}

// Adapted from https://wordpress.org/support/topic/use-php-to-set-featured-image
// at some point should split into upload($filename) and attach($post_id, $attach_id)
function set_featured_image($post_id, $filename) {
  $filetitle = substr($filename, strrpos($filename, '/')+1);
  $attach_id = post_id_by_title($filetitle);

  // Check whether post already has image
  $thumbnail_id = get_post_thumbnail_id($post_id);
  if (strlen($thumbnail_id) > 0) {
    $attach_id = $thumbnail_id;
    echo 'Post '.$post_id.' already has featured image<br>';
  }
  else {
    // See whether image title already exists
    if ($attach_id < 0) {
      $wp_filetype = wp_check_filetype($filename, null);
      $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title' => $filetitle,
      'post_content' => '',
      'post_status' => 'inherit'
      );

      $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
      // you must first include the image.php file
      // for the function wp_generate_attachment_metadata() to work
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      echo 'Uploaded attachment '.$filetitle.' with ID '.$attach_id.'<br>';
    }
    else {
      echo 'Attachment '.$filetitle.' already exists with ID '.$attach_id.'<br>';
    }

    // add featured image to post
    // add_post_meta($post_id, '_thumbnail_id', $attach_id);
    // echo $attach_id;

    set_post_thumbnail( $post_id, $attach_id );
  }

  echo 'Post '.$post_id.': image '.$attach_id.'<br>';
}



// //testing with http://dev.zumic.com/events/test-event-db/
// $new_price = round((mt_rand() / mt_getrandmax())*100, 2);
// update_database($new_price, 100867, 'price_superstar');

// $wpdb_result = $wpdb->update(
//   $wpdb->postmeta,
//   array(
//     'meta_value' => (string)$new_price
//     ),
//   array(
//     'post_id' => 100867,
//     'meta_key' => 'price_superstar'
//     )
//   );

//$wpdb_result = $wpdb->update($wpdb->postmeta, array("meta_value"=>"99.30"), array("post_id"=>97196, "meta_key"=>"price_superstar"));

//echo 'donny';


?>

<?php

global $wpdb;
$insert_count = 0;
$update_count = 0;
$untouched_count = 0;
date_default_timezone_set("EST");

$log_path = '/var/www/sites/zumic.com/wp-content/themes/zumic-backbone/out_log.php';
$log_data = "<br><b>".date("D F j, Y, g:i a", strtotime("+1 hour"))."</b><br>"; //date
// file_put_contents($log_path, $log_data, FILE_APPEND);
echo "Imported on ".$log_data;

//PASTE UPDATE PHP HERE
//Frank Turner at The Fillmore in San Francisco on Oct 20, 2015
$post_id = post_id_by_title("Frank Turner at The Fillmore in San Francisco on Oct 20, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-10-20%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at The Fillmore in San Francisco on Oct 20, 2015",
           "post_name"=>"frank-turner-at-the-fillmore-in-san-francisco-on-oct-20-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at The Fillmore in San Francisco on Oct 20, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-10-20");
       update_post_meta($post_id, "event_date", "2015-10-20");
       update_post_meta($post_id, "event_time", "20:00");
       update_post_meta($post_id, "location", "San Francisco");
       update_post_meta($post_id, "venue", "The Fillmore");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//The Fillmore
if (!$event_exists) {
wp_set_object_terms($post_id, "The Fillmore", "venue-name");
}

$venue_id = post_id_by_title("The Fillmore");
if ($venue_id < 0) {
       echo "The Fillmore does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



if (!$geo_update_success) {
  if (!$event_exists) {
      update_post_meta($post_id, "gp_latitude", "37.78423920");
      update_post_meta($post_id, "gp_longitude", "-122.43329360");
  }
  update_post_meta($venue_id, "gp_latitude", "37.78423920");
  update_post_meta($venue_id, "gp_longitude", "-122.43329360");
  $geo_update_success = True;
}
update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3347992867&a=200107&m=4103");


//Frank Turner at House of Blues San Diego in San Diego on Oct 23, 2015
$post_id = post_id_by_title("Frank Turner at House of Blues San Diego in San Diego on Oct 23, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-10-23%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at House of Blues San Diego in San Diego on Oct 23, 2015",
           "post_name"=>"frank-turner-at-house-of-blues-san-diego-in-san-diego-on-oct-23-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at House of Blues San Diego in San Diego on Oct 23, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-10-23");
       update_post_meta($post_id, "event_date", "2015-10-23");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "San Diego");
       update_post_meta($post_id, "venue", "House of Blues San Diego");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//House of Blues San Diego
if (!$event_exists) {
wp_set_object_terms($post_id, "House of Blues San Diego", "venue-name");
}

$venue_id = post_id_by_title("House of Blues San Diego");
if ($venue_id < 0) {
       echo "House of Blues San Diego does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



if (!$geo_update_success) {
  if (!$event_exists) {
      update_post_meta($post_id, "gp_latitude", "32.71637340");
      update_post_meta($post_id, "gp_longitude", "-117.16008560");
  }
  update_post_meta($venue_id, "gp_latitude", "32.71637340");
  update_post_meta($venue_id, "gp_longitude", "-117.16008560");
  $geo_update_success = True;
}
update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3347992877&a=200107&m=4103");


//Frank Turner at House of Blues Houston in Houston on Oct 29, 2015
$post_id = post_id_by_title("Frank Turner at House of Blues Houston in Houston on Oct 29, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-10-29%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at House of Blues Houston in Houston on Oct 29, 2015",
           "post_name"=>"frank-turner-at-house-of-blues-houston-in-houston-on-oct-29-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at House of Blues Houston in Houston on Oct 29, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-10-29");
       update_post_meta($post_id, "event_date", "2015-10-29");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Houston");
       update_post_meta($post_id, "venue", "House of Blues Houston");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//House of Blues Houston
if (!$event_exists) {
wp_set_object_terms($post_id, "House of Blues Houston", "venue-name");
}

$venue_id = post_id_by_title("House of Blues Houston");
if ($venue_id < 0) {
       echo "House of Blues Houston does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3347992907&a=200107&m=4103");


//Frank Turner at Venue Cymru in Llandudno on Nov 5, 2015
$post_id = post_id_by_title("Frank Turner at Venue Cymru in Llandudno on Nov 5, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-05%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at Venue Cymru in Llandudno on Nov 5, 2015",
           "post_name"=>"frank-turner-at-venue-cymru-in-llandudno-on-nov-5-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at Venue Cymru in Llandudno on Nov 5, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-05");
       update_post_meta($post_id, "event_date", "2015-11-05");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Llandudno");
       update_post_meta($post_id, "venue", "Venue Cymru");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//Venue Cymru
if (!$event_exists) {
wp_set_object_terms($post_id, "Venue Cymru", "venue-name");
}

$venue_id = post_id_by_title("Venue Cymru");
if ($venue_id < 0) {
       echo "Venue Cymru does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3348138987&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "41.30");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3348036035&a=200107&m=4307");


//Frank Turner at O2 Guildhall Southampton in Southampton on Nov 6, 2015
$post_id = post_id_by_title("Frank Turner at O2 Guildhall Southampton in Southampton on Nov 6, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-06%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at O2 Guildhall Southampton in Southampton on Nov 6, 2015",
           "post_name"=>"frank-turner-at-o2-guildhall-southampton-in-southampton-on-nov-6-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at O2 Guildhall Southampton in Southampton on Nov 6, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-06");
       update_post_meta($post_id, "event_date", "2015-11-06");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Southampton");
       update_post_meta($post_id, "venue", "O2 Guildhall Southampton");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//O2 Guildhall Southampton
if (!$event_exists) {
wp_set_object_terms($post_id, "O2 Guildhall Southampton", "venue-name");
}

$venue_id = post_id_by_title("O2 Guildhall Southampton");
if ($venue_id < 0) {
       echo "O2 Guildhall Southampton does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3347623249&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "54.99");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3348036473&a=200107&m=4307");


//Frank Turner at O2 Guildhall Southampton in Southampton on Nov 7, 2015
$post_id = post_id_by_title("Frank Turner at O2 Guildhall Southampton in Southampton on Nov 7, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-07%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at O2 Guildhall Southampton in Southampton on Nov 7, 2015",
           "post_name"=>"frank-turner-at-o2-guildhall-southampton-in-southampton-on-nov-7-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at O2 Guildhall Southampton in Southampton on Nov 7, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-07");
       update_post_meta($post_id, "event_date", "2015-11-07");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Southampton");
       update_post_meta($post_id, "venue", "O2 Guildhall Southampton");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//O2 Guildhall Southampton
if (!$event_exists) {
wp_set_object_terms($post_id, "O2 Guildhall Southampton", "venue-name");
}

$venue_id = post_id_by_title("O2 Guildhall Southampton");
if ($venue_id < 0) {
       echo "O2 Guildhall Southampton does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3351178445&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "46.02");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3353775171&a=200107&m=4307");


//Frank Turner at Falmouth Pavilions in Falmouth on Nov 9, 2015
$post_id = post_id_by_title("Frank Turner at Falmouth Pavilions in Falmouth on Nov 9, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-09%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at Falmouth Pavilions in Falmouth on Nov 9, 2015",
           "post_name"=>"frank-turner-at-falmouth-pavilions-in-falmouth-on-nov-9-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at Falmouth Pavilions in Falmouth on Nov 9, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-09");
       update_post_meta($post_id, "event_date", "2015-11-09");
       update_post_meta($post_id, "event_time", "7:00");
       update_post_meta($post_id, "location", "Falmouth");
       update_post_meta($post_id, "venue", "Falmouth Pavilions");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//Falmouth Pavilions
if (!$event_exists) {
wp_set_object_terms($post_id, "Falmouth Pavilions", "venue-name");
}

$venue_id = post_id_by_title("Falmouth Pavilions");
if ($venue_id < 0) {
       echo "Falmouth Pavilions does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_stubhub", "82.60");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3348036417&a=200107&m=4307");


//Frank Turner at Barrowland in Glasgow on Nov 13, 2015
$post_id = post_id_by_title("Frank Turner at Barrowland in Glasgow on Nov 13, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-13%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at Barrowland in Glasgow on Nov 13, 2015",
           "post_name"=>"frank-turner-at-barrowland-in-glasgow-on-nov-13-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at Barrowland in Glasgow on Nov 13, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-13");
       update_post_meta($post_id, "event_date", "2015-11-13");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Glasgow");
       update_post_meta($post_id, "venue", "Barrowland");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//Barrowland
if (!$event_exists) {
wp_set_object_terms($post_id, "Barrowland", "venue-name");
}

$venue_id = post_id_by_title("Barrowland");
if ($venue_id < 0) {
       echo "Barrowland does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3349344207&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "76.29");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3348035871&a=200107&m=4307");


//Frank Turner at Newcastle University in Newcastle Upon Tyne on Nov 14, 2015
$post_id = post_id_by_title("Frank Turner at Newcastle University in Newcastle Upon Tyne on Nov 14, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-14%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at Newcastle University in Newcastle Upon Tyne on Nov 14, 2015",
           "post_name"=>"frank-turner-at-newcastle-university-in-newcastle-upon-tyne-on-nov-14-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at Newcastle University in Newcastle Upon Tyne on Nov 14, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-14");
       update_post_meta($post_id, "event_date", "2015-11-14");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Newcastle Upon Tyne");
       update_post_meta($post_id, "venue", "Newcastle University");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//Newcastle University
if (!$event_exists) {
wp_set_object_terms($post_id, "Newcastle University", "venue-name");
}

$venue_id = post_id_by_title("Newcastle University");
if ($venue_id < 0) {
       echo "Newcastle University does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3347973997&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "177.00");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3348035889&a=200107&m=4307");


//Frank Turner at Rock City in Nottingham on Nov 15, 2015
$post_id = post_id_by_title("Frank Turner at Rock City in Nottingham on Nov 15, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-15%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at Rock City in Nottingham on Nov 15, 2015",
           "post_name"=>"frank-turner-at-rock-city-in-nottingham-on-nov-15-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at Rock City in Nottingham on Nov 15, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-15");
       update_post_meta($post_id, "event_date", "2015-11-15");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Nottingham");
       update_post_meta($post_id, "venue", "Rock City");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//Rock City
if (!$event_exists) {
wp_set_object_terms($post_id, "Rock City", "venue-name");
}

$venue_id = post_id_by_title("Rock City");
if ($venue_id < 0) {
       echo "Rock City does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3347973977&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "58.00");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3348035979&a=200107&m=4307");


//Frank Turner at Rock City in Nottingham on Nov 16, 2015
$post_id = post_id_by_title("Frank Turner at Rock City in Nottingham on Nov 16, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-16%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at Rock City in Nottingham on Nov 16, 2015",
           "post_name"=>"frank-turner-at-rock-city-in-nottingham-on-nov-16-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at Rock City in Nottingham on Nov 16, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-16");
       update_post_meta($post_id, "event_date", "2015-11-16");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Nottingham");
       update_post_meta($post_id, "venue", "Rock City");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//Rock City
if (!$event_exists) {
wp_set_object_terms($post_id, "Rock City", "venue-name");
}

$venue_id = post_id_by_title("Rock City");
if ($venue_id < 0) {
       echo "Rock City does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3351177709&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "82.60");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3351276611&a=200107&m=4307");


//Frank Turner at O2 Academy Birmingham in Birmingham on Nov 18, 2015
$post_id = post_id_by_title("Frank Turner at O2 Academy Birmingham in Birmingham on Nov 18, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-18%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at O2 Academy Birmingham in Birmingham on Nov 18, 2015",
           "post_name"=>"frank-turner-at-o2-academy-birmingham-in-birmingham-on-nov-18-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at O2 Academy Birmingham in Birmingham on Nov 18, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-18");
       update_post_meta($post_id, "event_date", "2015-11-18");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Birmingham");
       update_post_meta($post_id, "venue", "O2 Academy Birmingham");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//O2 Academy Birmingham
if (!$event_exists) {
wp_set_object_terms($post_id, "O2 Academy Birmingham", "venue-name");
}

$venue_id = post_id_by_title("O2 Academy Birmingham");
if ($venue_id < 0) {
       echo "O2 Academy Birmingham does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3347973993&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "82.60");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3348035857&a=200107&m=4307");


//Frank Turner at O2 Academy Sheffield in Sheffield on Nov 19, 2015
$post_id = post_id_by_title("Frank Turner at O2 Academy Sheffield in Sheffield on Nov 19, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-19%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at O2 Academy Sheffield in Sheffield on Nov 19, 2015",
           "post_name"=>"frank-turner-at-o2-academy-sheffield-in-sheffield-on-nov-19-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at O2 Academy Sheffield in Sheffield on Nov 19, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-19");
       update_post_meta($post_id, "event_date", "2015-11-19");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Sheffield");
       update_post_meta($post_id, "venue", "O2 Academy Sheffield");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//O2 Academy Sheffield
if (!$event_exists) {
wp_set_object_terms($post_id, "O2 Academy Sheffield", "venue-name");
}

$venue_id = post_id_by_title("O2 Academy Sheffield");
if ($venue_id < 0) {
       echo "O2 Academy Sheffield does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3347973995&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "59.00");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3348036485&a=200107&m=4307");


//Frank Turner at Colston Hall in Bristol on Nov 21, 2015
$post_id = post_id_by_title("Frank Turner at Colston Hall in Bristol on Nov 21, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-11-21%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Frank Turner%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') 
   AND wp_posts.post_title LIKE '%%Frank Turner%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Frank Turner%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Frank Turner%%') OR wp_posts.post_title LIKE '%%Frank Turner%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Frank Turner at Colston Hall in Bristol on Nov 21, 2015",
           "post_name"=>"frank-turner-at-colston-hall-in-bristol-on-nov-21-2015",
           "post_date"=>"2015-09-17 04:18:23",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Frank Turner at Colston Hall in Bristol on Nov 21, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-11-21");
       update_post_meta($post_id, "event_date", "2015-11-21");
       update_post_meta($post_id, "event_time", "19:00");
       update_post_meta($post_id, "location", "Bristol");
       update_post_meta($post_id, "venue", "Colston Hall");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Frank Turner'
        "));

       foreach ($genres as $genre) {
            wp_set_object_terms($post_id, $genre->name, "music-genres", True);
            echo $genre->name;
       }
       $event_exists = False;
       $insert_count += 1;
   }
   else {
       $post_id = $postids[0];
       $update_count += 1;
   }
}
else {
   $untouched_count += 1;
}
       wp_set_object_terms($post_id, "Frank Turner", "post_tag", True);
       update_post_meta($post_id, "artists", "Frank Turner");
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET menu_order='945' WHERE ID=".$post_id));
$geo_update_success = False;

//Colston Hall
if (!$event_exists) {
wp_set_object_terms($post_id, "Colston Hall", "venue-name");
}

$venue_id = post_id_by_title("Colston Hall");
if ($venue_id < 0) {
       echo "Colston Hall does not exist";
}
else {
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (!empty($lat) && !event_exists) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon) && !event_exists) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "25.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3347973981&a=200107&m=3589");
update_post_meta($post_id, "price_stubhub", "94.95");
update_post_meta($post_id, "url_stubhub", "http://www.awin1.com/pclick.php?p=3348035877&a=200107&m=4307");


$fold = file_get_contents($log_path);
$wpdb->insert("wp_outlog", array("data"=>$log_data));
$log_data = $log_data.$fold;
file_put_contents($log_path, $log_data);
echo "Inserted ".$insert_count." new events, updated ".$update_count." existing events, and left ".$untouched_count." untouched (although these could have had updates to ticket links or latitude/longitude). \n";

//^THERE
?>