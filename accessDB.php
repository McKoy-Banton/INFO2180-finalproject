<?php

$host = 'localhost';
$username = 'mcKoy';  #change this field
$password = '12345'; #change this field
$dbname = 'dolphin_crm'; # do not change this field

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

return $conn;


#to use it copy: $conn= require __DIR__ . "/accessDB.php";
?>