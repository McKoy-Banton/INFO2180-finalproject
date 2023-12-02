<?php 
session_start();

if (!isset($_SESSION["user_id"])) 
{
    header("Location: login.php");
    exit;
}

echo $_SESSION["user_id"];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <li><a href="logout.php"> <button>Log Out</button> </a></li>
</head>
<body>
    
</body>
</html>