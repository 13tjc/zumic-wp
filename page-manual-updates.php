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
$log_data = "<br><b>".date("D F j, Y, g:i a")."</b><br>"; //date
// file_put_contents($log_path, $log_data, FILE_APPEND);
echo "Imported on ".$log_data;

//PASTE UPDATE PHP HERE
//Drake at Empire Polo Field in Indio, CA on Apr 17, 2015
$post_id = post_id_by_title("Drake at Empire Polo Field in Indio, CA on Apr 17, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-04-17%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Drake%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') 
   AND wp_posts.post_title LIKE '%%Drake%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Drake%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') OR wp_posts.post_title LIKE '%%Drake%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Drake at Empire Polo Field in Indio, CA on Apr 17, 2015",
           "post_name"=>"drake-at-empire-polo-field-in-indio-ca-on-apr-17-2015",
           "post_date"=>"2015-04-13 18:59:06",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Drake at Empire Polo Field in Indio, CA on Apr 17, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-04-17");
       update_post_meta($post_id, "event_date", "2015-04-17");
       update_post_meta($post_id, "event_time", "03:30");
       update_post_meta($post_id, "location", "Indio, CA");
       update_post_meta($post_id, "venue", "Empire Polo Field");
       wp_set_object_terms($post_id, "Drake", "post_tag", True);
       update_post_meta($post_id, "artists", "Drake");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Drake'
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
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='Drake' WHERE ID=".$post_id));
$geo_update_success = False;

//Empire Polo Field
$venue_id = post_id_by_title("Empire Polo Field");
if ($venue_id < 0) {
       echo "Empire Polo Field does not exist";
}
else {
      if (!$event_exists) {
          wp_set_object_terms($post_id, "Empire Polo Field", "venue-name");
      }
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (! empty($lat)) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon)) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_superstar", "34.50");
update_post_meta($post_id, "url_superstar", "http://www.awin1.com/cread.php?awinaffid=200107&awinmid=4037&p=http://www.superstartickets.com/Coachella-AC-DC-Jack-White-and-Drake-Weekend-2-3-Day-Pass-2334789");
update_post_meta($post_id, "price_viagogo", "338.35");
update_post_meta($post_id, "url_viagogo", "http://www.awin1.com/pclick.php?p=3105449845&a=200107&m=5821");


//Drake at Toyota Center - TX in Houston, TX on May 24, 2015
$post_id = post_id_by_title("Drake at Toyota Center - TX in Houston, TX on May 24, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-05-24%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Drake%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') 
   AND wp_posts.post_title LIKE '%%Drake%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Drake%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') OR wp_posts.post_title LIKE '%%Drake%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Drake at Toyota Center - TX in Houston, TX on May 24, 2015",
           "post_name"=>"drake-at-toyota-center-tx-in-houston-tx-on-may-24-2015",
           "post_date"=>"2015-04-13 18:59:08",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Drake at Toyota Center - TX in Houston, TX on May 24, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-05-24");
       update_post_meta($post_id, "event_date", "2015-05-24");
       update_post_meta($post_id, "event_time", "03:30");
       update_post_meta($post_id, "location", "Houston, TX");
       update_post_meta($post_id, "venue", "Toyota Center - TX");
       wp_set_object_terms($post_id, "Drake", "post_tag", True);
       update_post_meta($post_id, "artists", "Drake");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Drake'
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
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='Drake' WHERE ID=".$post_id));
$geo_update_success = False;

//Toyota Center - TX
$venue_id = post_id_by_title("Toyota Center - TX");
if ($venue_id < 0) {
       echo "Toyota Center - TX does not exist";
}
else {
      if (!$event_exists) {
          wp_set_object_terms($post_id, "Toyota Center - TX", "venue-name");
      }
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (! empty($lat)) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon)) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_superstar", "224.25");
update_post_meta($post_id, "url_superstar", "http://www.awin1.com/cread.php?awinaffid=200107&awinmid=4037&p=http://www.superstartickets.com/Drake-2549068");


//Drake at Palace Of Auburn Hills in Auburn Hills, MI on May 27, 2015
$post_id = post_id_by_title("Drake at Palace Of Auburn Hills in Auburn Hills, MI on May 27, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-05-27%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Drake%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') 
   AND wp_posts.post_title LIKE '%%Drake%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Drake%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') OR wp_posts.post_title LIKE '%%Drake%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Drake at Palace Of Auburn Hills in Auburn Hills, MI on May 27, 2015",
           "post_name"=>"drake-at-palace-of-auburn-hills-in-auburn-hills-mi-on-may-27-2015",
           "post_date"=>"2015-04-13 18:59:08",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Drake at Palace Of Auburn Hills in Auburn Hills, MI on May 27, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-05-27");
       update_post_meta($post_id, "event_date", "2015-05-27");
       update_post_meta($post_id, "event_time", "03:30");
       update_post_meta($post_id, "location", "Auburn Hills, MI");
       update_post_meta($post_id, "venue", "Palace Of Auburn Hills");
       wp_set_object_terms($post_id, "Drake", "post_tag", True);
       update_post_meta($post_id, "artists", "Drake");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Drake'
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
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='Drake' WHERE ID=".$post_id));
$geo_update_success = False;

//Palace Of Auburn Hills
$venue_id = post_id_by_title("Palace Of Auburn Hills");
if ($venue_id < 0) {
       echo "Palace Of Auburn Hills does not exist";
}
else {
      if (!$event_exists) {
          wp_set_object_terms($post_id, "Palace Of Auburn Hills", "venue-name");
      }
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (! empty($lat)) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon)) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_superstar", "23.00");
update_post_meta($post_id, "url_superstar", "http://www.awin1.com/cread.php?awinaffid=200107&awinmid=4037&p=http://www.superstartickets.com/Drake-2549069");


//Drake at Centre Bell in Montreal, QC on May 31, 2015
$post_id = post_id_by_title("Drake at Centre Bell in Montreal, QC on May 31, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-05-31%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Drake%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') 
   AND wp_posts.post_title LIKE '%%Drake%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Drake%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') OR wp_posts.post_title LIKE '%%Drake%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Drake at Centre Bell in Montreal, QC on May 31, 2015",
           "post_name"=>"drake-at-centre-bell-in-montreal-qc-on-may-31-2015",
           "post_date"=>"2015-04-13 18:59:09",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Drake at Centre Bell in Montreal, QC on May 31, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-05-31");
       update_post_meta($post_id, "event_date", "2015-05-31");
       update_post_meta($post_id, "event_time", "03:30");
       update_post_meta($post_id, "location", "Montreal, QC");
       update_post_meta($post_id, "venue", "Centre Bell");
       wp_set_object_terms($post_id, "Drake", "post_tag", True);
       update_post_meta($post_id, "artists", "Drake");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Drake'
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
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='Drake' WHERE ID=".$post_id));
$geo_update_success = False;

//Centre Bell
$venue_id = post_id_by_title("Centre Bell");
if ($venue_id < 0) {
       echo "Centre Bell does not exist";
}
else {
      if (!$event_exists) {
          wp_set_object_terms($post_id, "Centre Bell", "venue-name");
      }
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (! empty($lat)) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon)) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_superstar", "224.25");
update_post_meta($post_id, "url_superstar", "http://www.awin1.com/cread.php?awinaffid=200107&awinmid=4037&p=http://www.superstartickets.com/Drake-2549070");


//Drake at Air Canada Centre in Toronto, ON on Jun 2, 2015
$post_id = post_id_by_title("Drake at Air Canada Centre in Toronto, ON on Jun 2, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-06-02%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Drake%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') 
   AND wp_posts.post_title LIKE '%%Drake%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Drake%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') OR wp_posts.post_title LIKE '%%Drake%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Drake at Air Canada Centre in Toronto, ON on Jun 2, 2015",
           "post_name"=>"drake-at-air-canada-centre-in-toronto-on-on-jun-2-2015",
           "post_date"=>"2015-04-13 18:59:09",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Drake at Air Canada Centre in Toronto, ON on Jun 2, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-06-02");
       update_post_meta($post_id, "event_date", "2015-06-02");
       update_post_meta($post_id, "event_time", "03:30");
       update_post_meta($post_id, "location", "Toronto, ON");
       update_post_meta($post_id, "venue", "Air Canada Centre");
       wp_set_object_terms($post_id, "Drake", "post_tag", True);
       update_post_meta($post_id, "artists", "Drake");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Drake'
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
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='Drake' WHERE ID=".$post_id));
$geo_update_success = False;

//Air Canada Centre
$venue_id = post_id_by_title("Air Canada Centre");
if ($venue_id < 0) {
       echo "Air Canada Centre does not exist";
}
else {
      if (!$event_exists) {
          wp_set_object_terms($post_id, "Air Canada Centre", "venue-name");
      }
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (! empty($lat)) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon)) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_superstar", "224.25");
update_post_meta($post_id, "url_superstar", "http://www.awin1.com/cread.php?awinaffid=200107&awinmid=4037&p=http://www.superstartickets.com/Drake-2549071");


//Drake at Finsbury Park in London on Jun 28, 2015
$post_id = post_id_by_title("Drake at Finsbury Park in London on Jun 28, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-06-28%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Drake%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') 
   AND wp_posts.post_title LIKE '%%Drake%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Drake%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') OR wp_posts.post_title LIKE '%%Drake%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Drake at Finsbury Park in London on Jun 28, 2015",
           "post_name"=>"drake-at-finsbury-park-in-london-on-jun-28-2015",
           "post_date"=>"2015-04-13 18:59:10",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Drake at Finsbury Park in London on Jun 28, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-06-28");
       update_post_meta($post_id, "event_date", "2015-06-28");
       update_post_meta($post_id, "event_time", "13:00");
       update_post_meta($post_id, "location", "London");
       update_post_meta($post_id, "venue", "Finsbury Park");
       wp_set_object_terms($post_id, "Drake", "post_tag", True);
       update_post_meta($post_id, "artists", "Drake");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Drake'
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
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='Drake' WHERE ID=".$post_id));
$geo_update_success = False;

//Finsbury Park
$venue_id = post_id_by_title("Finsbury Park");
if ($venue_id < 0) {
       echo "Finsbury Park does not exist";
}
else {
      if (!$event_exists) {
          wp_set_object_terms($post_id, "Finsbury Park", "venue-name");
      }
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (! empty($lat)) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon)) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "69.50");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3255531585&a=200107&m=3589");
update_post_meta($post_id, "price_ticketmaster", "69.50");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3255535459&a=200107&m=3589");


//Drake at Finsbury Park in London on Jul 3, 2015
$post_id = post_id_by_title("Drake at Finsbury Park in London on Jul 3, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-07-03%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Drake%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') 
   AND wp_posts.post_title LIKE '%%Drake%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Drake%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') OR wp_posts.post_title LIKE '%%Drake%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Drake at Finsbury Park in London on Jul 3, 2015",
           "post_name"=>"drake-at-finsbury-park-in-london-on-jul-3-2015",
           "post_date"=>"2015-04-13 18:59:11",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Drake at Finsbury Park in London on Jul 3, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-07-03");
       update_post_meta($post_id, "event_date", "2015-07-03");
       update_post_meta($post_id, "event_time", "12:00");
       update_post_meta($post_id, "location", "London");
       update_post_meta($post_id, "venue", "Finsbury Park");
       wp_set_object_terms($post_id, "Drake", "post_tag", True);
       update_post_meta($post_id, "artists", "Drake");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Drake'
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
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='Drake' WHERE ID=".$post_id));
$geo_update_success = False;

//Finsbury Park
$venue_id = post_id_by_title("Finsbury Park");
if ($venue_id < 0) {
       echo "Finsbury Park does not exist";
}
else {
      if (!$event_exists) {
          wp_set_object_terms($post_id, "Finsbury Park", "venue-name");
      }
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (! empty($lat)) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon)) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "69.50");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3202786747&a=200107&m=3589");
update_post_meta($post_id, "price_ticketmaster", "69.50");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3202786745&a=200107&m=3589");
update_post_meta($post_id, "price_ticketmaster", "69.50");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3202605023&a=200107&m=3589");
update_post_meta($post_id, "price_viagogo", "249.98");
update_post_meta($post_id, "url_viagogo", "http://www.awin1.com/pclick.php?p=3202709161&a=200107&m=2448");
update_post_meta($post_id, "price_viagogo", "249.98");
update_post_meta($post_id, "url_viagogo", "http://www.awin1.com/pclick.php?p=3202709159&a=200107&m=2448");
update_post_meta($post_id, "price_viagogo", "339.77");
update_post_meta($post_id, "url_viagogo", "http://www.awin1.com/pclick.php?p=3202709155&a=200107&m=2448");
update_post_meta($post_id, "price_viagogo", "107.36");
update_post_meta($post_id, "url_viagogo", "http://www.awin1.com/pclick.php?p=3202901859&a=200107&m=5821");
update_post_meta($post_id, "price_viagogo", "353.70");
update_post_meta($post_id, "url_viagogo", "http://www.awin1.com/pclick.php?p=3202901825&a=200107&m=5821");
update_post_meta($post_id, "price_viagogo", "263.01");
update_post_meta($post_id, "url_viagogo", "http://www.awin1.com/pclick.php?p=3202901829&a=200107&m=5821");
update_post_meta($post_id, "price_viagogo", "263.01");
update_post_meta($post_id, "url_viagogo", "http://www.awin1.com/pclick.php?p=3202901835&a=200107&m=5821");


//Drake at Joe&#39;s on Weed Street in Chicago on Jul 10, 2015
$post_id = post_id_by_title("Drake at Joe&#39;s on Weed Street in Chicago on Jul 10, 2015");
$event_exists = True;
if ($post_id < 0) {
   $postids = $wpdb->get_col($wpdb->prepare(   
   "SELECT * FROM wp_posts 
   INNER JOIN wp_postmeta ON wp_posts.ID=wp_postmeta.post_id 
   AND wp_postmeta.meta_key='event_date' AND wp_postmeta.meta_value LIKE '%%2015-07-10%%' 
   INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id 
   INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id 
   LEFT JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id 
   AND wp_terms.name LIKE '%%Drake%%' 
   LEFT JOIN wp_postmeta meta_artists ON wp_posts.ID=meta_artists.post_id 
   AND (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') 
   AND wp_posts.post_title LIKE '%%Drake%%' 
   WHERE wp_posts.post_type = 'events' 
   AND (wp_terms.name LIKE '%%Drake%%' OR (meta_artists.meta_key='artists' AND meta_artists.meta_value LIKE '%%Drake%%') OR wp_posts.post_title LIKE '%%Drake%%')
   "));
   if (sizeof($postids) < 1) {
       $wpdb->insert("wp_posts", array(
           "post_title"=>"Drake at Joe&#39;s on Weed Street in Chicago on Jul 10, 2015",
           "post_name"=>"drake-at-joe-39-s-on-weed-street-in-chicago-on-jul-10-2015",
           "post_date"=>"2015-04-13 18:59:11",
           "post_type"=>"events"
       ));
       $post_id = $wpdb->insert_id;
       $post_row = $wpdb->get_row("SELECT post_name FROM wp_posts WHERE ID=".$post_id);
       $post_name = $post_row->post_name;
       $log_data = $log_data."<a href='http://zumic.com/events/".$post_name."'>Drake at Joe&#39;s on Weed Street in Chicago on Jul 10, 2015</a> (<a href='http://zumic.com/wp-admin/post.php?post=".$post_id."&action=edit"."'>edit</a>)<br>";
       update_post_meta($post_id, "time_date", "2015-07-10");
       update_post_meta($post_id, "event_date", "2015-07-10");
       update_post_meta($post_id, "event_time", "23:00");
       update_post_meta($post_id, "location", "Chicago");
       update_post_meta($post_id, "venue", "Joe&#39;s on Weed Street");
       wp_set_object_terms($post_id, "Drake", "post_tag", True);
       update_post_meta($post_id, "artists", "Drake");
       $genres = $wpdb->get_results($wpdb->prepare(
          "SELECT wp_terms.name
          FROM wp_posts
          INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
          INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
          AND wp_term_taxonomy.taxonomy = 'music-genres'
          INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
          WHERE wp_posts.post_type = 'artists'
          AND wp_posts.post_title LIKE 'Drake'
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
  echo $wpdb->query($wpdb->prepare("UPDATE wp_posts SET post_content='Drake' WHERE ID=".$post_id));
$geo_update_success = False;

//Joe&#39;s on Weed Street
$venue_id = post_id_by_title("Joe&#39;s on Weed Street");
if ($venue_id < 0) {
       echo "Joe&#39;s on Weed Street does not exist";
}
else {
      if (!$event_exists) {
          wp_set_object_terms($post_id, "Joe&#39;s on Weed Street", "venue-name");
      }
      $geo_update_success = True;
      $lat = get_post_meta($venue_id, "location_latitude", true);
      if (! empty($lat)) {
        update_post_meta($post_id, "gp_latitude", $lat);
      }
      else {
          $geo_update_success = False;
      }
      $lon = get_post_meta($venue_id, "location_longitude", true);
      if (! empty($lon)) {
        update_post_meta($post_id, "gp_longitude", $lon);
      }
      else {
          $geo_update_success = False;
      }
}



update_post_meta($post_id, "price_ticketmaster", "0.00");
update_post_meta($post_id, "url_ticketmaster", "http://www.awin1.com/pclick.php?p=3248215853&a=200107&m=4103");


$fold = file_get_contents($log_path);
$wpdb->insert("wp_outlog", array("data"=>$log_data));
$log_data = $log_data.$fold;
file_put_contents($log_path, $log_data);
echo "Inserted ".$insert_count." new events, updated ".$update_count." existing events, and left ".$untouched_count." untouched (although these could have had updates to ticket links or latitude/longitude). \n";

//^THERE
?>