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
<?php
    //Mode
    $testing = FALSE;

    function format_string($s) {
        $s = str_replace('\'', '\'"\'"\'', $s);
        // echo $s;
        return $s;
    }

    // Opening
    var_dump($_POST);

    // Events
    $err = '';
    if (strlen($_POST['artistz']) > 0) {
        chdir('/var/www/sites/zumic.com/wp-content/themes/zumic-backbone/ticketfiller/app/web');
        echo 'From runner: '.$__POST['artistz'].'<br>';
        $cmd = './multi.sh '.'\''.format_string($_POST['artistz']).'\' \''.format_string($_POST['aw_update']).'\' \''.format_string($_POST['ss_update']).'\'';

        // $cmd = $cmd.' "manual"';
        echo '<br>'.$cmd.'<br><br>';
        passthru($cmd, $err);
        echo '<br><br>'.$err;
    }

    // // Redirect to log
    // $url = 'http://zumic.com/log';
    // if (!$testing) {
    //     header('Location: '.$url);
    // }  

?>
</body>