<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "blogs";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Conexión Fallida:" .mysql_connect_error());
}

