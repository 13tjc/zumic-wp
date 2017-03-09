<html>
<head>
    <style>
        html {
            font-family: Verdana, Geneva, sans-serif;
        }
        .log {
            margin: 50px;
            font-family: Courier New, monospace;
        }
    </style>
    <title>Done!</title>
    <h2>Done!</h2>
</head>
<body>
<a href="http://zumic.com/wp-content/themes/zumic-backbone/ticketfiller/app/web/">Main Page</a> | <a href="http://zumic.com/wp-content/themes/zumic-backbone/ticketfiller/app/web/progress.php" target="_blank">Progress Report</a> | <a href="http://zumic.com/log">Output Log</a>
<hr><br><br>
<b>Output dump:</b><br>
<div class="log">
<?php
    function format_string($s) {
        $s = str_replace('\'', '\'"\'"\'', $s);
        echo $s;
        return $s;
    }

    //Testing mode gives output dump, otherwise redirect to log
    $testing = TRUE;
    // $testing = FALSE;

    // Output suppression p1
    if (!$testing) {
        ob_start();
    }

    // Sleep (old)
    $delay = 0;
    if ($_POST['delay']) {
        $delay = $_POST['delay'];
    }
    echo 'Delay: '.$delay;
    // echo 'Sleeping '.$delay.'s at '.date('h:i:s').'\n';
    // sleep($delay);
    // echo 'Woke up at '.date('h:i:s').'\n';

    // Opening echoes
    // echo 'hi '.getcwd().'<br><br>';
    var_dump($_POST);
    var_dump($_FILES);

    // Featured image
    $image_name = basename($_POST['featuredimage_name']);
    $image_success = FALSE;
    
    // Feat image URL base
    $url_base = 'http://zumic.com/wp-content/themes/zumic-backbone/ticketfiller/app/web/images/';
    $upload_dir = wp_upload_dir();
    $url_base = $upload_dir['path'] . '/';
    $image_path = $url_base.$image_name;
    $image_path_url = str_replace('var/www/sites/zumic.com/', '', $image_path);
    echo '$image_path: '.$image_path;

    // // Check folder permission and define file location
    // if( wp_mkdir_p( $upload_dir['path'] ) ) {
    //   $url_base = $upload_dir['path'] . '/';
    // }
    // else {
    //   $url_base = $upload_dir['basedir'] . '/';
    // }

    if (strlen($_FILES['featuredimage_file']['tmp_name']) > 0) {
        echo $_FILES['featuredimage_file']['name'];
        echo $_POST['featuredimage_name'];

        // Setting vars for upload and filetype
        $upload_image = TRUE;
        $image_filetype = pathinfo($image_path, PATHINFO_EXTENSION);
        
        // Check temporary image type
        if (isset($_POST['submit'])) {
            $is_image = getimagesize($_FILES['featuredimage_file']['tmp_name']);
            if (!$is_image) {
                echo 'Not an image';
                $upload_image = FALSE;
            }
        }
        
        // Check for existing image
        if (file_exists($image_path)) {
            echo '<br><b>Featured image: file already exists</b><br>';
            $upload_image = FALSE;
            $image_success = TRUE;
            // echo 'Warning: overwrote existing file';
        }
        
        // Check file size
        if ($_FILES['featuredimage_file']['size'] > 1000000) {
            echo 'Sorry, image too large';
            $upload_image = FALSE;
        }
        
        // Filetype check
        if($image_filetype != "jpg" && $image_filetype != "png" && $image_filetype != "jpeg"
        && $image_filetype != "gif" ) {
            echo "Only JPG, JPEG, PNG & GIF accepted";
            $upload_image = FALSE;
        }
        
        // Success/error
        if ($upload_image) {
            if (move_uploaded_file($_FILES['featuredimage_file']['tmp_name'], $image_path)) {
                $image_success = TRUE;
                echo 'Successful upload to '.$image_path;
            }
            else {
                echo 'Error uploading featured image to '.$image_path;
            }
        }

        if ($image_success) {
            echo '<br><br><b><a href="'.$image_path_url.'" target="_blank"><img src="'.$image_path_url.'"><br>Click to view image</a></b><br><br>';
        }
    }
    else {
        echo 'No featured image chosen';
    }

    // Events for artist
    $err = '';
    if (strlen($_POST['artist']) > 0) {
        chdir('/var/www/sites/zumic.com/wp-content/themes/zumic-backbone/ticketfiller/app/web');
        echo 'From runner: '.$__POST['artist'];
        $cmd = './main.sh '.'\''.format_string($_POST['artist']).'\' \''.format_string($_POST['secondaries']).'\' \''.$_POST['aw_update'].'\' \''.$_POST['ss_update'].'\' \''.format_string($_POST['body_content']).'\' \''.format_string($delay).'\'';
        if ($image_success) {
            $cmd = $cmd.' \''.format_string($image_path).'\'';
        }
        else {
            $cmd = $cmd.' \'\'';
        }
        if ($_POST['auto'] == 'auto') {
            $cmd = $cmd.' \'auto\'';
        }
        else {
            $cmd = $cmd.' \'manual\'';
        }
        // $cmd = $cmd.' "manual"';
        echo '<br>'.$cmd.'<br><br>';
        passthru($cmd, $err);
        echo '<br><br>'.$err;
    }

    // Output suppression p2
    if (!$testing) {
        while (ob_get_contents()) {
            ob_end_clean();
        }
    }

    // Redirect to log
    $url = 'http://zumic.com/log';
    if (!$testing) {
        header('Location: '.$url);
    }   
?>
</div>
</body>
</html>