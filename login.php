<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <script src="js/login.js"></script>
    <title>Login</title>
</head>

<header class="header_bar">
    <p><img src="img/logo.png" alt="Badge Image" id="logo"> Dolphin CRM</p>
</header>

<body>

     <main>
        <div  class="container">

            <div> <h2 id="header">Login</h2> </div>

            <div id="invalid">

            </div>

                        
            <form>
            
                <div><input type="email" placeholder="Email address" name="email" id="email"></div>
                <div><input type="password" placeholder="Password" name="password" id="password"></div>
                <div> <button><img src="img/lock.png" alt="Lock Image" id="lock">Login</button></div>
                
            </form>

            <p id="copyright">Copyright © 2022 Dolphin CRM</p>
        </div>
        
     </main>
</body>
</html>