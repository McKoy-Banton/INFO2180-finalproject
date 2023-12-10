<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file
    $conn = require __DIR__ . "/accessDB.php"; // Replace with your actual database connection file

    // Function to sanitize and validate input
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Sanitize and validate form data
    $firstName = sanitizeInput($_POST["FirstName"]);
    $lastName = sanitizeInput($_POST["LastName"]);
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);
    $role = sanitizeInput($_POST["Role"]);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database 
    //TODO: Check the insert!!
    $sql = "INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $role);

    // Execute the statement
    if ($stmt->execute()) {
        echo "User added successfully to the database.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addUser.css">
    <script>src="addUserAJAX.js"</script>
    <title>Add User Profile</title>
</head>

<header class="header_bar">
    <p><img src="img/logo.png" alt="Badge Image" id="logo"> Dolphin CRM</p>
</header>

<body>

    <main>
        <div> <h2 id="header">New User</h2> </div>
        
        <div class="container">

        <form action="addUser.php" method="POST">
            <label for="fname">First name</label><br>
            <div><input type="text" placeholder="Jane" name="FirstName" id="fname" required aria-invalid="true"></div>
            
            <label for="lname">Last name</label><br>
            <div><input type="text" placeholder="Doe" name="LastName" id="lname" required aria-invalid="true"></div>
            
            <label for="email">Email Address</label><br>
            <div><input type="email" placeholder="something@example.com" name="email" id="email" required aria-invalid="true"></div>
            
            <label for="password">Password</label><br>
            <div><input type="password" placeholder="1 uppercase; 1 lower case; 1 number; at least 8 characters" name="password" id="password" required aria-invalid="true" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"
            required title="Password must have at least 1 lowercase letter, 1 uppercase letter, 1 digit, and be at least 8 characters long."></div>
            
            <div>
                <label for="role">Role</label><br>
                <select name="Role" id="role">
                    <option value="Admin">Admin</option>
                    <option value="Member">Member</option>
                </select>
            </div>

            <div><button id="AddUser">Save</button></div>
        </form>

        <div id="response-message"></div>

        </div>

    </main>
</body>
</html>