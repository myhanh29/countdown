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
        <div class="<?php echo ($page === 'appointmentlist') ? 'container1' : 'container'; ?>">
            <div class="topnav">
                <?php if (!isset($_SESSION["user"]["email"])) { ?><a href="index.php?page=login" <?php if ($page == "login") { ?> class='active' <?php } ?> >Anmelden</a><?php } ?>
                <?php if (!isset($_SESSION["user"]["email"])) { ?><a href="index.php?page=register" <?php if ($page == "register") { ?> class='active' <?php } ?> >Registieren</a> <?php } ?>

                <?php if (isset($_SESSION["user"]["email"])) { ?>
                    <a href="javascript: user_logout();">Abmelden</a>
                <?php } ?>

                <?php if (isset($_SESSION["user"]["email"])) { ?><a href="index.php?page=appointmentlist&event=user_appointmentlist" <?php if ($page == "appointmentlist") { ?> class='active' <?php } ?> >Termine</a> <?php } ?>
                <?php if (isset($_SESSION["user"]["email"])) { ?>
                    <a href="index.php?page=appointment&event=user_appointment"  <?php if ($page == "appointment") { ?>class='active'<?php } ?>>Termine erstellen</a>
                <?php } else if ($page == "appointment" && $event == "user_editappointment") { ?>
                    <a href="index.php?page=appointment&event=user_editappointment" class='active'>Termine bearbeiten</a>
                <?php } ?>
                <?php if (isset($_SESSION["user"]["email"])) { ?>
                    <a <?php if ($page == "home") { ?> class="active" <?php } ?> href="index.php?page=home&event=user_countdown">Startseite</a>
                <?php } else { ?>
                    <a <?php if ($page == "home") { ?> class="active" <?php } ?> href="index.php">Startseite</a>
                <?php } ?>
            </div>

            <div id='content'>

                <?php
                require_once("tpl/$page.php");
                ?>

            </div>
        </div>
    </body>
    <script src="javascript/countdown.js"></script>
    <script src="javascript/checken.js"></script>
    <script src="javascript/confirm.js"></script>

    <script>
        function user_logout() {
            window.location.href = 'index.php?page=login&event=user_logout';
        }
    </script>

</html>