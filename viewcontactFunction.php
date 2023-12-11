<?php 
session_start();

if (!isset($_SESSION["user_id"])) 
{
  header("Location: dashboard.php");
    exit;
}

$conn= require __DIR__ . "/accessDB.php";

$id = $_SESSION["user_id"];
date_default_timezone_set('America/Jamaica');


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['comment'])){

        $sql= sprintf("SELECT * FROM users where id = $id");
        $result= $conn->query($sql);
        $user = $result->fetch_assoc();


        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $contactId = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date = date('Y-m-d H:i:s');

        //CODE TO ADD NEW NOTE TO DATABASE
        $sql = sprintf("INSERT INTO notes (contact_id, comment, created_by, created_at) 
                            VALUES ( ?, ?, ?, ?)"); 
        $results = $conn->prepare($sql);
        $results->bind_param("ssss",$contactId, $comment,$id,$date);
        

        
        if($results->execute())
        {


            echo "<div class=\"written-notes\">";
            echo "<h4>" .$user['firstname'] . " ".$user['lastname']. "</h4>";
            echo "<p class=\"pnotes\">" . $comment . "</p>";
            echo "<p class=\"date\">" . convertDateFormat(substr(date('Y-m-d H:i:s'), 0, 10)) . " at" . substr($date, 10) . "</p>";
            echo "</div>";

        }       
        
        //CODE TO PUT NEW NOTE ON PAGE


    }
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {




    if(isset($_GET['assign']))
    {
        $contactId = filter_var($_GET['assign'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sql = sprintf("UPDATE contacts SET assigned_to= ? , updated_at = NOW() WHERE id = ?");
        $results = $conn->prepare($sql);
       
        $results->bind_param("si", $id,$contactId); 
        if($results->execute())
        {
         $sql  = sprintf("SELECT * FROM users where id = $id");
         $result = $conn ->query($sql);
         $created_by = $result->fetch_assoc();

         $sql= sprintf("SELECT * FROM contacts where id = $contactId");
         $result= $conn->query($sql);
         $contact = $result->fetch_assoc();
         $newUpdatedAt = convertDateFormat(substr($contact['updated_at'], 0, 10));

         echo  $created_by['firstname'] . " " .  $created_by['lastname'] . "," . $newUpdatedAt ;

        }
       

       
    }

    if(isset($_GET['switch'])){
        $contactId = filter_var($_GET['switch'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $newType = filter_var($_GET['to'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = sprintf("UPDATE contacts SET type= ? , updated_at = NOW() WHERE id = ?");
        $results = $conn->prepare($sql);
       
        $results->bind_param("si",  $newType,$contactId); 
        if($results->execute())
        {
         $sql= sprintf("SELECT * FROM contacts where id = $contactId");
         $result= $conn->query($sql);
         $contact = $result->fetch_assoc();
         $newUpdatedAt = convertDateFormat(substr($contact['updated_at'], 0, 10));

         echo  $contact["type"] . "," . $newUpdatedAt ;

        }
    }


}







function convertDateFormat($date){
    $date = explode("-", $date);
    $monthNum  = $date[1];
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');
    return $monthName . " " . $date[2] . " " . $date[0];
}
?>


