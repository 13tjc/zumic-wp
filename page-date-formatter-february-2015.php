<?php
//echo 'require';
//require_once("../../../wp-load.php");
//put ../shared/page-date-formatter-february-2015.php
?>

<?php
echo 'hi<br><br>';
global $wpdb;
//var_dump($wpdb);

function to_month($digit) {
    $d = (int) $digit;
    $m = "";
    switch ($d) {
        case 1:
            $m = "Jan";
            break;
        case 2:
            $m = "Feb";
            break;
        case 3:
            $m = "Mar";
            break;
        case 4:
            $m = "Apr";
            break;
        case 5:
            $m = "May";
            break;
        case 6:
            $m = "Jun";
            break;
        case 7:
            $m = "Jul";
            break;
        case 8:
            $m = "Aug";
            break;
        case 9:
            $m = "Sep";
            break;
        case 10:
            $m = "Oct";
            break;
        case 11:
            $m = "Nov";
            break;
        case 12:
            $m = "Dec";
            break;
    }

    return $m;
}


// //TITLE FORMATTING
// echo 'asdf';

// //trailing commas
// // $title_ids = $wpdb->get_col($wpdb->prepare(
// //     "SELECT * FROM wp_posts
// //      WHERE post_type='events'
// //      AND post_title RLIKE '.*,  [0-9].*'"
// // ));

// //in [blank]
// // $title_ids = $wpdb->get_col($wpdb->prepare(
// //     "SELECT * FROM wp_posts
// //      WHERE post_type='events'
// //      AND post_title RLIKE '.* in  [0-9].*'"
// // ));

// //in nan
// $title_ids = $wpdb->get_col($wpdb->prepare(
//     "SELECT * FROM wp_posts
//      WHERE post_type='events'
//      AND post_title RLIKE '.* in nan [0-9].*'"
// ));

// foreach ($title_ids as $id) {
//     //get title
//     $title = $wpdb->get_var($wpdb->prepare(
//         "SELECT post_title FROM wp_posts
//          WHERE ID=".$id
//     ));

//     //edit

//     //trailing commas
//     // $title = str_replace(", ", "", $title);

//     //in [blank]
//     // $title = str_replace("in ", "", $title);

//     //in [blank]
//     $title = str_replace("in nan ", "", $title);


//     //update in database
//     $result = $wpdb->update(
//         'wp_posts',
//         array('post_title' => $title),
//         array('ID' => $id)
//     );
//     if ($result === false) {
//         echo "false: ".$wpdb->print_error()."<br>";
//     }
//     else {
//         echo "successful update<br>";
//     }

//     echo $id.": ".$title."<br><br>";
// }


//DATE FORMATTING
//test ID is 157290
$event_ids = $wpdb->get_col($wpdb->prepare(
    "SELECT ID FROM wp_posts
     WHERE post_type='events'
     AND post_title LIKE '%%2015'"
));

var_dump($event_ids);
echo '<br><br>';

foreach ($event_ids as $id) {
    //get title
    $title = $wpdb->get_var($wpdb->prepare(
        "SELECT post_title FROM wp_posts
         WHERE ID=".$id
    ));
    $updated = false;
    // echo "old title: ".$title."<br>";

    //make necessary date alterations
    $datetext_arr = array();
    if (preg_match("/\d+\.\d+\.\d+$/", $title, $datetext_arr)) {
        $datetext = $datetext_arr[0];
        // echo "datetext: ".$datetext."<br>";
        $date_arr = array();

        //date formatting
        if (preg_match_all("/\d+/", $datetext, $date_arr)) {
            $date_arr = $date_arr[0];
            // echo $date_arr."<br>";
            if (sizeof($date_arr) > 2) {
                $month = to_month($date_arr[0]);
                $day = (int) $date_arr[1];
                $year = $date_arr[2];

                // echo $month." ".$day.", ".$year."<br><br>";

                //then update the title field by replacement
                if (sizeof($month) > 0) {
                    $datetext_new = " on ".$month." ".$day.", ".$year;
                    $title = str_replace($datetext, $datetext_new, $title);
                    $updated = true;
                }
            }
        }
    }
    else {
        echo "date format doesn't fit MM.DD.YYYY<br>";
    }

    //update in database
    $result = $wpdb->update(
        'wp_posts',
        array('post_title' => $title),
        array('ID' => $id)
    );
    if ($result === false) {
        echo "false: ".$wpdb->print_error()."<br>";
    }
    else {
        if ($updated) {
            echo "successful update<br>";
        }
    }

    echo $id.": ".$title."<br><br>";
}

?>

