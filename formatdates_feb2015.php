<?php
echo 'require';
require_once("../../../wp-load.php");
?>

<?php
echo 'sa';
echo 'hi';
global $wpdb;
var_dump($wpdb);

function to_month($digit) {
    $d = (int) $digit;
    $m = "";
    switch ($d) {
        case 1:
            $m = "January";
            break;
        case 2:
            $m = "February";
            break;
        case 3:
            $m = "March";
            break;
        case 4:
            $m = "April";
            break;
        case 5:
            $m = "May";
            break;
        case 6:
            $m = "June";
            break;
        case 7:
            $m = "July";
            break;
        case 8:
            $m = "August";
            break;
        case 9:
            $m = "September";
            break;
        case 10:
            $m = "October";
            break;
        case 11:
            $m = "November";
            break;
        case 12:
            $m = "December";
            break;
    }

    return $m;
}

$event_ids = $wpdb->get_col($wpdb->prepare(
    "SELECT ID FROM wp_posts
     WHERE post_type='events'
     AND ID=157290"
));

foreach ($event_ids as $id) {
    //get title
    $title = $wpdb->get_var($wpdb->prepare(
        "SELECT post_title FROM wp_posts
         WHERE ID=".$id
    ));

    //make necessary date alterations
    $datetext_arr = array();
    if (preg_match("/\d+\.\d+.\d+$/", $title, $datetext_arr)) {
        $datetext = $datetext_arr[0];
        $date_arr = array();

        //date formatting
        preg_match_all("/\d+/", $datetext, $date_arr);
        if (sizeof($date_arr) > 2) {
            $month = to_month($date_arr[0]);
            $day = (int) $date_arr[1];
            $year = $date_arr[2];

            //then update the title field by replacement
            if (sizeof($month) > 0) {
                $datetext_new = $month." ".$day.", ".$year;
                $title = str_replace($datetext, $datetext_new, $title);
            }
        }
    }

    //update in database
    $wpdb->update(
        $wpdb->wp_posts,
        array("post_title" => $title),
        array("ID" => $id)
    );

    echo $id.": ".$title;
}

?>

