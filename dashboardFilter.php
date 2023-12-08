<?php 
session_start();

if (!isset($_SESSION["user_id"])) 
{
  header("Location: dashboard.php");
    exit;
}

$conn= require __DIR__ . "/accessDB.php";

$id = $_SESSION["user_id"];

if($_SERVER['REQUEST_METHOD'] == 'GET'){
  if($_GET['filter'] == "all")
  {
    $sql= sprintf("SELECT * FROM contacts");
    $result= $conn->query($sql);
    echo displayTableContact($result);

  }elseif($_GET['filter'] == "sales")
  {
    $sql= sprintf("SELECT * FROM contacts where type = 'Sales Lead' ");
    $result= $conn->query($sql);
    echo displayTableContact($result);
  }elseif($_GET['filter'] == "support")
  {
    $sql= sprintf("SELECT * FROM contacts where type = 'Support' ");
    $result= $conn->query($sql);
    echo displayTableContact($result);

  }elseif($_GET['filter'] == "assigned"){
    $sql= sprintf("SELECT * FROM contacts where assigned_to =  $id " );
    $result= $conn->query($sql);
    echo displayTableContact($result);

  }
}




function displayTableContact($results){
    $contacts = "";
    foreach ($results as $contact){ 
        $type = "";
        if($contact['type'] == "Support"){$type = "support";}
        if($contact['type'] == "Sales Lead"){$type = "sales-lead";}
    
        $contacts .= 
        "<tr>
            <td><a id= \"link\" href=\"viewcontact.php?view=".  $contact['id']."\"><p id = \"name\">" . $contact['title'] ." ". $contact['firstname'] ." ". $contact['lastname'] . "</p></a></td> 
            <td>" . $contact['email'] . "</td> 
            <td>" . $contact['company'] . "</td> 
            <td><span class=\"" . $type . "\">" . $contact['type'] . "</span></td> 
            <td><a id= \"link\" href=\"viewcontact.php?view=".  $contact['id']."\">View</a></td>        
        </tr>";
    }
    return $contacts;
}

?>