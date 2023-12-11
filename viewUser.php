<?php
session_start();

if (!isset($_SESSION["user_id"])) 
{
    header("Location: dashboard.php");
    exit;
}

$conn= require __DIR__ . "/accessDB.php";


$result = mysqli_query($conn,"SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/viewUser.css">
    <script src="js/addUserBtn.js"></script>
</head>
<body>
    <div class="header">
        <img class="logo" src="img/logo.png" alt="Dolphin CRM Logo">
        <h4>Dolphin CRM</h4>
    </div>

    <div class="container">
        <aside>
            <ul>
                <a href="dashboard.php"><li><i class="material-icons">home</i>Home</li></a>
                <a href="addContact.php"><li><i class="material-icons">account_circle</i>New Contact</li></a>
                <a href="viewUser.php"><li><i class="material-icons">people_outline</i>Users</li></a>
                <br>
                <hr>
                <a href="logout.php"><li><i class="material-icons">exit_to_app</i>Logout</li></a>
            </ul>
        </aside>

        <section>
            <div class="mainpageHeader">
                <h1>Users</h1>
                <a  id = "Add_button" href="addUserPage.php"><button>Add User</button></a>
            </div>
            <div class="table">
                <?php
                    if($row = mysqli_fetch_array($result)){
                        echo "<table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created</th>
                                </tr> 
                            </thead>";
                        while($row = mysqli_fetch_array($result)) {
                            echo "<tbody><tr><td width=25%>".$row['firstname']." ".$row['lastname']."</td><td width=25%>".$row['email']."</td><td width=25%>".$row['role']."</td><td width=25%>".$row['created_at']."</td>";
                        }
                        echo "</table>";
                    }
                ?>
            </div>
        </section>
    </div>
</body>
</html>