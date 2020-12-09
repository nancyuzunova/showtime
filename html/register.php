<?php
    session_start();

    include("Connection.php");
    include("Registration.php");

    $first_name = "";
    $last_name = "";
    $gender = "";
    $email = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $registration = new Registration();
        $result = $registration->evaluate($_POST);

        if($result != ""){
            echo "<div style='text-align:center; font-size: 12px; color: white; background-color: gray'>";
            echo "<br>The following errors occurred:<br><br>";
            echo $result;
            echo "</div>";
            header("Location: login_page.php?error=true");
        } else {
            header("Location: profile.php");
            die;
        }

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
    }