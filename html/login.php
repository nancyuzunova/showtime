<?php
    session_start();

    include("Connection.php");
    include("Loging.php");

    $email = "";
    $password = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $login = new Loging();
        $result = $login->login($_POST);

        if ($result != "") {
            echo "<div style='text-align:center; font-size: 12px; color: white; background-color: gray'>";
            echo "<br>The following errors occurred:<br><br>";
            echo $result;
            echo "</div>";
        } else {
            header("Location: profile.php");
            die;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
    }
