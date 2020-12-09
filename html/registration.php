<?php

    include("Connection.php");
    include("signup.php");

    $first_name = "";
    $last_name = "";
    $gender = "";
    $email = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != ""){
            echo "<div style='text-align:center; font-size: 12px; color: white; background-color: gray'>";
            echo "<br>The following errors occurred:<br><br>";
            echo $result;
            echo "</div>";
        } else {
            header("Location: profile.php");
            die;
        }

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
    }
?>