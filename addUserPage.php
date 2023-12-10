<?php
session_start();

if (!isset($_SESSION["user_id"])) 
{
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addUser.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Add User</title>
    
    <header class="header_bar">
        <p><img src="img/logo.png" alt="Badge Image" id="logo"> Dolphin CRM</p>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </header>
 
   
</head>
<body>
<script src="addUser.js"></script>
<div class="sidebar">

    <a href="#" class="currentPage"><li><i class="material-icons">home</i>Home</li></a>
    <a href="#"><li><i class="material-icons">account_circle</i>New Contact</li></a>
    <a href="#"><li><i class="material-icons">people_outline</i>Users</li></a>
    <hr>
    <a href="logout.php"><li><i class="material-icons">exit_to_app</i>Logout</li></a>
            
</div>
<div class="content">
    <div class="card">

    <main>
            <header>
                <h1>New User</h1>
            </header>

            <section>

                <form action="addUser.php", method="post">
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
            </section>
        </main>

    </div>
</div>


</body>
</html>