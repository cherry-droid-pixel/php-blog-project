<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "blog_project";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>