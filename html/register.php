<?php
    session_start();

    include("Connection.php");
    include("Registration.php");

    $firstName = "";
    $lastName = "";
    $gender = "";
    $email = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $registration = new Registration();
        $resultRegister = $registration->evaluate($_POST);

        if($resultRegister != ""){
            include("signUpPage.php");
        } else {
            header("Location: profile.php");
            die;
        }

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
    }