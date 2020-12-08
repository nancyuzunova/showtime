<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "showtime";

$connection = mysqli_connect($host, $username, $password, $db);

$firstName = "Ivan";
$lastName = "Nushkov";

$query = "insert into users (firstName, lastName) values ('$firstName', '$lastName')";

echo $query;