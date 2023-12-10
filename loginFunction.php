<?php

session_start();
$isinvalid=true;

function verifySHA256($data, $expectedHash) 
{
    $calculatedHash = hash('sha256', $data);

    if ($calculatedHash === $expectedHash) 
    {
        return true;
    } 
    else 
    {
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"]==="POST")
{

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $conn= require __DIR__ . "/accessDB.php";

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // Assuming 's' for a string; adjust if necessary
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) 
    {
       $user = $result->fetch_assoc();

       if(verifySHA256($_POST["password"], $user["password"]))
       {
           $isinvalid=false; 
           $_SESSION["user_id"]=$user["id"];
           echo "grant access";
           
           exit;

       }

       else
       {
            $isinvalid=false;
            echo "login failed";
       }
    } 
    else 
    {
        echo "login failed";
    }
    

    
}

?>

