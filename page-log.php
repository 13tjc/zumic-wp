<?php
//Based on zebra pagination template
// how many records should be displayed on a page?
$records_per_page = 12;
$cur_page = 1;

//get the current page number if avail
if ($_GET) {
    if (isset($_GET['pg'])) {
        $cur_page = $_GET['pg'];
    }
}


$MySQL = '
    SELECT
        data
    FROM
        wp_outlog
    WHERE data LIKE "%%a href%%"
    ORDER BY id DESC
    LIMIT
        ' . (($cur_page-1) * $records_per_page) . ', ' . $records_per_page . '
';

// $MySQL = 'SELECT * FROM wp_outlog'

global $wpdb;

// if query could not be executed
// if (!($result = @mysql_query($MySQL))) {
if (!($result = $wpdb->get_col($wpdb->prepare($MySQL)))) {

    // stop execution and display error message
    die(mysql_error());

}


// echo '<br>'; print_r($result); echo '<br>';

// fetch the total number of records in the table
// $rows = mysql_fetch_assoc(mysql_query('SELECT FOUND_ROWS() AS rows'));
$rows = $wpdb->get_col($wpdb->prepare('SELECT COUNT(*) AS rows FROM wp_outlog'));
$num_rows = 0;
if (sizeof($rows) > 0) {
    $num_rows = $rows[0];
}
$num_pages = ceil($num_rows/$records_per_page);

//DISPLAY
echo '<style>html{font-family:Verdana, Geneva, sans-serif;}</style>';
echo '<title>Zumic Ticketfiller Output Log</title>';
echo '<h2>Zumic Ticketfiller Output Log</h2>';

if ($cur_page > 1) {
    echo '<a href="http://zumic.com/log/?pg='.($cur_page-1).'">prev</a> | ';
}
echo 'Page '.$cur_page.' of '.$num_pages;
if ($cur_page < $num_pages) {
    echo ' | <a href="http://zumic.com/log/?pg='.($cur_page+1).'">next</a> ';
}
echo '<hr>';


foreach ($result as $entry) {
    $pos = strpos($entry, '<a href');
    if ($pos !== false) {
        echo $entry;
    }
}

echo '<hr>';
if ($cur_page > 1) {
    echo '<a href="http://zumic.com/log/?pg='.($cur_page-1).'">prev</a> | ';
}
echo 'Page '.$cur_page.' of '.$num_pages;
if ($cur_page < $num_pages) {
    echo ' | <a href="http://zumic.com/log/?pg='.($cur_page+1).'">next</a> ';
}

?>