<?php
    session_start();

    include("Connection.php");
    include("Logging.php");

    $email = "";
    $password = "";


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = new Logging();
        $resultLogin = $login->login($_POST);

        if ($resultLogin != "") {
            include("login_page.php");
        } else {
            header("Location: profile.php");
            die;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
    }
