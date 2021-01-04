<?php
    include("loader.php");

    //check if user is logged in
    if(isset($_SESSION['showtime_userid']) && is_numeric($_SESSION['showtime_userid'])){
        $user_id = $_SESSION['showtime_userid'];
        $user = new User();
        $user_data = $user->getUser($user_id);
    }else{
        header("Location: loginPage.php");
        die;
    }

    if (isset($_SERVER['HTTP_REFERER'])) {
        $return_to = $_SERVER['HTTP_REFERER'];
    } else {
        $return_to = "profile.php";
    }

    if (isset($_GET['type']) && isset($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $allowed[] = 'post';
            $allowed[] = 'user';
            $allowed[] = 'comment';
            if (in_array($_GET['type'], $allowed)) {
                $post = new Post();
                $user = new User();
                $post->likePost($_GET['id'], $_GET['type'], $_SESSION['showtime_userid']);

                if($_GET['type'] == "user"){
                    $user->followUser($_GET['id'], $_GET['type'], $_SESSION['showtime_userid']);
                }
            }
        }
    }

    header("Location: " . $return_to);
    die;