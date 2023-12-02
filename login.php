<?php
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
    $conn= require __DIR__ . "/accessDB.php";

    $sql= sprintf("SELECT * FROM users WHERE email  = '%s'", 
          $conn-> real_escape_string ($_POST["email"]));

    $result= $conn->query($sql);

    $user= $result->fetch_assoc();
    
    
    if($user)
    {
        if(verifySHA256($_POST["password"], $user["password"]))
       {
           $isinvalid=false; 
           session_start();
           $_SESSION["user_id"]=$user["id"];
           header("Location: dashboard.php");
           exit;

       }

       else
       {
            $isinvalid=false;
       }
    }

    else
    {
        $isinvalid=false;
    }

    
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<header class="header_bar">
    <p><img src="img/logo.png" alt="Badge Image" id="logo"> Dolphin CRM</p>
</header>

<body>

     <main>
        <div  class="container">

            <div> <h2 id="header">Login</h2> </div>

            <?php
             if(!$isinvalid)
             {
                echo "<h4> Invalid data entered </h4>";
             }
            ?>
                        
            <form method="POST">
            
                <div><input type="email" placeholder="Email address" name="email" id="email"></div>
                <div><input type="password" placeholder="Password" name="password" id="password"></div>
                <div> <button><img src="img/lock.png" alt="Lock Image" id="lock">Login</button></div>
                
            </form>

            <p id="copyright">Copyright © 2022 Dolphin CRM</p>
        </div>
        
     </main>
</body>
</html>