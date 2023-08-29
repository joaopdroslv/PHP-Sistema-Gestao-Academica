<?php
//CREATE DATABASE CONNECTION
define ( 'DB_HOST', 'localhost');
define ( 'DB_USER', 'root');
define ( 'DB_PASSWORD', '');
define ( 'DB_NAME', 'faculdade');

//CREATE CONNECTION USING MYSQLI_CONNECT()
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//IF $conn IS FALSE, CONNECTION IS FAILED
if (!$conn) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
    exit;
} else {
    //echo "Conexão bem sucedida!!!";
}
?>