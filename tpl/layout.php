<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>

    <head>
        <link rel="stylesheet" href="css/style.css">
        <title>COUNTDOWN</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>


    <body>
        <div class="image"></div>
        <div class='container'>
            <div class="topnav">
                <?php if (!isset($_SESSION["email"])) { ?><a href="index.php?page=login" <?php if ($page == "login") { ?> class='active' <?php } ?> >Login</a><?php } ?>
                <?php if (!isset($_SESSION["email"])) { ?><a href="index.php?page=register" <?php if ($page == "register") { ?> class='active' <?php } ?> >Register</a> <?php } ?>
                <?php if (isset($_SESSION["email"])) { ?>
                    <a href="javascript: user_logout();">Logout</a>
                <?php } ?>

                <a <?php if ($page == "home") { ?> class="active" <?php } ?> href="index.php">Home</a>

            </div>
      
            <div id='content'>
                 <?php
    {
        require_once("tpl/$page.php");
    }
    ?>
            </div>
        </div>
    </body>
    <script src="javascript/countdown.js"></script>
    <script src="javascript/checken.js"></script>

    <script>
        function user_logout() {
            window.location.href = 'index.php?page=login&event=user_logout';
        }
    </script>
 
</html>