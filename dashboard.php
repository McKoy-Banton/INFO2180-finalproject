<?php 
session_start();

if (!isset($_SESSION["user_id"])) 
{
    header("Location: login.php");
    exit;
}

$conn= require __DIR__ . "/accessDB.php";


$sql= sprintf("SELECT * FROM contacts");

$result= $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="js/dashboard.js"></script>
    <title>Dashboard</title>
    <header class="header_bar">
      
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </header>
 
   
</head>
<body>
        <nav>
        <img src="img/logo.png" alt="Dolphin CRM LOGO" srcset="">
        <p>Dolphin CRM</p>
    </nav>
<div class="sidebar">

    <a href="#" class="currentPage"><li><i class="material-icons">home</i>Home</li></a>
    <a href="addContact.php"><li><i class="material-icons">account_circle</i>New Contact</li></a>
    <a href="viewUser.php"><li><i class="material-icons">people_outline</i>Users</li></a>
    <br>
    <hr>
    <a href="logout.php"><li><i class="material-icons">exit_to_app</i>Logout</li></a>
            
</div>



<div class="content">
    <div class="card">

    <main>
            <header>
                <h1>Dashboard</h1>
                <a href="addContact.php"><i class="material-icons">group_add</i>Add Contact</a>
            </header>

            <section>
                <div class="controls">
                    <i class="material-icons">filter_list</i>
                    <h3>Filter By:</h3>
                    <button class="active filter-all">All</button>
                    <button class="filter-sales">Sales Leads</button>
                    <button class="filter-support">Support</button>
                    <button class="filter-assigned">Assigned to me</button>
                </div>

                

                

                <table>
                    <colgroup>
                        <col style="width: 25%">
                        <col style="width: 25%">
                        <col style="width: 25%">
                        <col style="width: 15%">
                        <col style="width: 10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Name</th> <th>Email</th> <th>Company</th> <th>Type</th>  <th></th>
                        </tr> 
                    </thead>
                    <?php 
                     foreach($result as $contact ):
                        $type;
                        if($contact['type'] == "Support"){$type = "support";}
                        if($contact['type'] == "Sales Lead"){$type = "sales-lead";}
                    ?>
                    <tr>
                            <td><a href="viewcontact.php?view=<?php echo $contact['id'] ?>" id= "link"><p id= "name"><?php echo $contact['title'].".".$contact['firstname']." ".$contact['lastname'] ?></p></a></td>
                            <td><?php echo $contact['email'] ?></td>
                            <td><?php echo $contact['company'] ?></td>
                            <td><?php echo "<span class=\"" . $type . "\">" . $contact['type'] . "</span>" ?></td>
                            <td><a href="viewcontact.php?view=<?php echo $contact['id'] ?>" id= "link">View</a></td> 
                    </tr>
                    <?php endforeach; ?> 
                    <tbody>
                    </tbody>
                 
                </table>
            </section>
        </main>

    </div>
</div>


</body>
</html>