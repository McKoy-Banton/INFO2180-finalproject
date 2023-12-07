<?php 
session_start();

if (!isset($_SESSION["user_id"])) 
{
    header("Location: dashboard.php");
    exit;
}

$conn= require __DIR__ . "/accessDB.php";


$sql= sprintf("SELECT * FROM contacts");
$result= $conn->query($sql);

$id = filter_var($_GET['view'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// contact information
$sql= sprintf("SELECT * FROM contacts where id = $id");
$result= $conn->query($sql);
$contact = $result->fetch_assoc();

$creator = $contact["created_by"];
$assigned = $contact["assigned_to"];
//Creator information
$sql  = sprintf("SELECT * FROM users where id = $creator ");
$result = $conn ->query($sql);
$created_by = $result->fetch_assoc();

// Assigned Contact
$sql  = sprintf("SELECT * FROM users where id = $assigned ");
$result = $conn ->query($sql);
$assigned_to = $result->fetch_assoc();

// Notes
$sql  = sprintf("SELECT * FROM notes where contact_id =  " . $contact["id"]);
$notes = $conn ->query($sql);


    
function convertDateFormat($date){
    
    $date = explode("-", $date);

    if(count($date) < 1){
        return "Not updated";
    }
    $monthNum  = $date[1];
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');
    return $monthName . " " . $date[2] . " " . $date[0];
}

function convertTimeFormat(){

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css//viewcontact.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Login</title>
</head>

<header class="header_bar">
    <p><img src="img/logo.png" alt="Badge Image" id="logo"> Dolphin CRM</p>
</header>

<body>

<div class="sidebar">

    <a href="dashboard.php" class="currentPage"><li><i class="material-icons">home</i>Home</li></a>
    <a href="create-contact.php"><li><i class="material-icons">account_circle</i>New Contact</li></a>
    <a href="view_users.php"><li><i class="material-icons">people_outline</i>Users</li></a>
    <hr>
    <a href="php/logout.php"><li><i class="material-icons">exit_to_app</i>Logout</li></a>
            
</div>

<section>
            <header>
                <div class="header-buttons">
                    <button type="button" id="switch"><i class="fas fa-exchange"></i>Switch to <?php if($contact['type'] == "Support"){echo "Sales Lead";} else{echo "Support";}?></button> 
                    <button type="button" id="assign"><i class="fas fa-hand-paper"></i>Assign to me</button> 
                    
                </div>
                <div class="image">
                        <img src="img/profilepic.png" alt="Contact Profile Picture"> <!--filler image-->

                        <div class="text">
                            <h1><?php echo $contact['title'] . " " . $contact['firstname'] . " " . $contact['lastname']?></h1> <!--filler text-->
                            <p>Created on <?php echo convertDateFormat(substr($contact['create_at'], 0, 10)) ?> by <?php echo $created_by['firstname'] . " " . $created_by['lastname']?></p>  <!--filler text-->
                            <p>Updated on <?php echo convertDateFormat(substr($contact['updated_at'], 0, 10)) ?></p>  <!--filler text-->
                        </div>
                </div>


            </header>

            <div class="info-container">
                <div class="contact-info">
                    <label for="email"><h4 style="color: #365871;">Email</h4></label>
                    <input type="email" id="email" name="email" value="<?php echo $contact['email']?>" readonly class="info-element">
                </div>

                <div class="contact-info">
                    <label for="telephone"><h4 style="color: #365871;">Telephone</h4></label>
                    <input type="text" id="telephone" name="telephone" value="<?php echo $contact['telephone']?>" readonly class="info-element">  <!--filler text-->
                </div>

                <div class="contact-info">
                    <label for="company"><h4 style="color: #365871;">Company</h4></label>
                    <input type="text" id="text" name="text" value="<?php echo $contact['company']?>" readonly class="info-element">  <!--filler text-->
                </div>

                <div class="contact-info">
                    <label for="assigned"><h4 style="color: #365871;">Assigned To</h4></label>
                    <input type="text" id="assigned" name="assigned" value="<?php echo $assigned_to['firstname'] . " " . $assigned_to['lastname']?>" readonly class="info-element">  <!--filler text-->
                </div>
            </div>


            <div class="n-container">
                    <div class="notes-container">
                        
                        <div class="notes-title">
                            <label for="notes">
                                <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                            </label>
                            <input type="text" value="Notes" readonly>
                        </div>


                    <div class="w-notes">
                        <?php
                            foreach($notes as $note){
                                //Getting name of person who made note
                                
                                $sql  = sprintf("SELECT * FROM users where id = $creator ");
                                $result = $conn ->query($sql);
                                $user = $result->fetch_assoc();
                                echo "<div class=\"written-notes\">";
                                    echo "<h4>" . $user['firstname'] . " " . $user['lastname'] . "</h4>";
                                    echo "<p class=\"pnotes\">" . $note['comment'] . "</p>";
                                    echo "<p class=\"date\">" . convertDateFormat(substr($note['create_at'], 0, 10)) . " at" . substr($note['create_at'], 10) . "</p>";
                                echo "</div>";
                            }
                        ?>
                    </div>    

                        <div class="add-notes">
                            <form>

                                <div class="editnotes">
                                <label for="editnotes">Add a Note about <?php echo $contact['title'] . " " . $contact['firstname']?></label> <!--filler text-->
                                <textarea name="editnotes" id="editnotes" cols="50" rows="10" placeholder="Enter details here"></textarea>
                                </div>

                                <div class="add-note-btn">
                                    <input type="submit" value="Add Note" class = "<?php echo $id?>" id="addNote">
                                </div>

                            </form>

                        </div>

                    </div>
            </div>    

        </section>
</body>
</html>
