<?php
    session_start();

    include("loader.php");

    $email = "";
    $password = "";


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = new Logging();
        $resultLogin = $login->login($_POST);

        if ($resultLogin != "") {
            include("loginPage.php");
        } else {
            header("Location: index.php");
            die;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
    }
