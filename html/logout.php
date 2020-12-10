<?php

    session_start();

    if(isset($_SESSION['showtime_userid'])) {
        $_SESSION['showtime_userid'] = NULL;
        unset($_SESSION['showtime_userid']);
    }

    header("Location: login_page.php");
    die;