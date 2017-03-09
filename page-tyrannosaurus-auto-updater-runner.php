<html>
<head>
    hello
</head>
<body>
<?php
    // Old from April 2015
    // ob_start();
    // echo $_POST['pass'];
    // // Events for artist
    // $err = '';
    // if (strlen($_POST['pass']) > 0) {
    //     chdir('/var/www/sites/zumic.com/wp-content/themes/zumic-backbone/ticketfiller/app/web');
    //     $cmd = './main.sh '.'"'.$_POST['pass'].'" "" "n" "n" "" "" "auto"';
    //     echo '<br>'.$cmd.'<br><br>';

    //     // TODO: figure out printing

    //     passthru($cmd, $err);
    //     echo '<br><br>'.$err;
    // }

    // while (ob_get_contents()) {
    //     ob_end_clean();
    // }

    global $wp_filter;
    var_dump($wp_filter['webticketfiller_update']);


    $endpoint = 'http://google.com/';
    $payload = array(
        'artist'=>'Zum!cMus1c2015',
        'aw_update'=>'y',
        'ss_update'=>'y',
        'featuredimage_name'=>'',
        'body_content'=>'',
        'auto'=>'auto'
    );
    $ch = curl_init($endpoint);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $resp = curl_exec($ch);
    // echo $resp;

    curl_exec($ch);
    curl_close($ch);

?>
</body>
</html>
