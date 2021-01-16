<?php
    session_start();

    include("loader.php");

    $firstName = "";
    $lastName = "";
    $email = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $registration = new Registration();
        $resultRegister = $registration->evaluate($_POST);

        if($resultRegister != ""){
            include("signUpPage.php");
        } else {
            header("Location: index.php");
            die;
        }

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
    }