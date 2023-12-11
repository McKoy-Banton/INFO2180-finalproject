<?php

session_start();


$id = $_SESSION["user_id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $conn = require __DIR__ . "/accessDB.php"; 
    
    $title = filter_var($_POST["title"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstName = filter_var($_POST["firstname"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName = filter_var($_POST["lastname"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $telephone = filter_var($_POST["telephone"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $company = filter_var($_POST["company"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $type = filter_var($_POST["type"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $assignedTo = filter_var($_POST["assign"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql;


        $sql = sprintf("INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) 
        VALUES (  ?, ?, ?,?,?,?,?,?,?, NOW(), NOW())");

    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("sssssssss",$title, $firstName, $lastName, $email,$telephone, $company,  $type, $assignedTo,$id);
    
    $response = '';

    if ($stmt->execute()) {
        $response = "Contact added successfully to the database.";
    } else {
        $response = "Error: " . $stmt->error;
    }
    echo $response;

    $stmt->close();
    $conn->close();

    
}


?>