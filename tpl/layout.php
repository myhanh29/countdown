<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>

    <head>
        <!-- Einbindung von externen Stylesheets und Titel der Webseite -->
        <link rel="stylesheet" href="css/style.css">
        <title>COUNTDOWN</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>


    <body>
        <!-- Hintergrundbild der Webseite -->
        <div class="image"></div>
        <!-- Hauptcontainer der Webseite -->
        <div class="<?php echo ($page === 'appointmentlist') ? 'container1' : 'container'; ?>">
            <!-- Navigationsleiste -->
            <div class="topnav">
           
                <!-- Links zur Anmeldung und Registrierung, abhängig davon, ob der Benutzer angemeldet ist -->
                <?php if (!isset($_SESSION["user"]["email"])) { ?><a href="index.php?page=login" <?php if ($page == "login") { ?> class='active' <?php } ?> >Anmelden</a><?php } ?>
                <?php if (!isset($_SESSION["user"]["email"])) { ?><a href="index.php?page=register" <?php if ($page == "register") { ?> class='active' <?php } ?> >Registieren</a> <?php } ?>

                  <!-- Links zum Abmelden und zu verschiedenen Seiten, abhängig davon, ob der Benutzer angemeldet ist -->
                <?php if (isset($_SESSION["user"]["email"])) { ?>
                    <a href="javascript: user_logout();">Abmelden</a>
                <?php } ?>
                <?php if (isset($_SESSION["user"]["email"])) { ?><a href="index.php?page=calendar&event=user_calendar" <?php if ($page == "calendar") { ?> class='active' <?php } ?> >Kalander</a> <?php } ?>

                <?php if (isset($_SESSION["user"]["email"])) { ?><a href="index.php?page=appointmentlist&event=user_appointmentlist" <?php if ($page == "appointmentlist") { ?> class='active' <?php } ?> >Termine</a> <?php } ?>

                <?php if (isset($_SESSION["user"]["email"])) { ?>
                    <a href="index.php?page=appointment&event=user_appointment"  <?php if ($page == "appointment" && $event == "user_appointment") { ?>class='active'<?php } ?>>Termine erstellen</a>
                <?php } ?>
                <!-- Bearbeitung von Terminen nur möglich ist, wenn der Link gewählt wird-->
                <?php if (isset($_SESSION["user"]["email"])) { ?>
                    <?php if ($page == "appointment" && $event == "user_editappointment") { ?>
                        <a href="index.php?page=appointment&event=user_editappointment" class='active'>Termine bearbeiten</a>
                        <?php
                    }
                }
                ?>
                <!-- Benutzer Liste nur sichtbar für Admin-->
                <?php if (isset($_SESSION["user"]["email"])) { ?>
                    <?php if ($_SESSION["user"]["adminrole"] == '1') { ?>   

                        <a href="index.php?page=userlist&event=admin_userlist"<?php if ($page == "userlist" && $event == "admin_userlist") { ?> class='active'<?php } ?>>Benutzer Liste</a>
                        <a href="index.php?page=backgroundchange&event=admin_change"<?php if ($page == "backgroundchange" && $event == "admin_change") { ?> class='active'<?php } ?>>Hintergrund ändern</a>
                        <?php
                    }
                }
                ?>
                 <!-- Wenn man sich schon angemeldet hat, wird die Seite mit Countdowntimer gezeigt. Sonst ist nur die Seite für Wilkommen sichtbar-->
                <?php if (isset($_SESSION["user"]["email"])) { ?>
                    <a <?php if ($page == "home") { ?> class="active" <?php } ?> href="index.php?page=home&event=user_countdown">Startseite</a>
                <?php } else { ?>
                    <a <?php if ($page == "home") { ?> class="active" <?php } ?> href="index.php">Startseite</a>
                <?php } ?>
            </div>
<!-- Inhalt der Seite -->
            <div id='content'>

                <?php
                 // Einbindung des Templates basierend auf der Variable $page
                require_once("tpl/$page.php");
                ?>

            </div>
        </div>
    </body>
    <!-- Einbindung von JavaScript-Dateien -->
    <script src="javascript/countdown.js"></script>
    <script src="javascript/checken.js"></script>
    <script src="javascript/confirm.js"></script>
    <script src="javascript/eventcalendar.js"></script>
    <script src="javascript/updatebackground.js"></script>

<!-- JavaScript-Funktion zum Abmelden des Benutzers -->
    <script>
        function user_logout() {
            window.location.href = 'index.php?page=login&event=user_logout';
        }
    </script>

</html>