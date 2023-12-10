<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $conn = require __DIR__ . "/accessDB.php"; 
    
    $firstName = filter_var($_POST["FirstName"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName = filter_var($_POST["LastName"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $role = filter_var($_POST["Role"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if (isset($_POST['FirstName']))
    {
        $sql = sprintf("INSERT INTO users (firstname, lastname, password, email, role, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    }
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("sssss", $firstName, $lastName, $hashedPassword, $email, $role);
    
    $response = '';

    if ($stmt->execute()) {
        $response = "User added successfully to the database.";
    } else {
        $response = "Error: " . $stmt->error;
    }
    echo $response;

    $stmt->close();
    $conn->close();

    
}