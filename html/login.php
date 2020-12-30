<?php
    session_start();

    include("Connection.php");
    include("Logging.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $emailError = "";
    $passwordError = "";

    if(empty($email)){
        $emailError = "Моля въведете вашия имейл!";
    }
    if(empty($password)){
        $passwordError = "Моля въведете вашата парола!";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = new Logging();
        $result = $login->login($_POST);

        if ($result != "") {
            include("login_page.php");
        } else {
            header("Location: profile.php");
            die;
        }
    }
