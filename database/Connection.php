<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "myBook_db";

$connection = mysqli_connect($host, $username, $password, $db);

$firstName = "Ivan";
$lastName = "Nushkov";

$query = "insert into users (firstName, lastName) values ('$firstName', '$lastName')";

echo $query;