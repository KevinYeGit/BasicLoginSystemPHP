<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "admin";

$dbName = "loginsystem";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if(!$conn){
     die("Nem sikerült csatlakozni: " .mysqli_connect_error());
}