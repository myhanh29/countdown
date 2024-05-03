<?php
// Neue Instanz der Klasse 'home' erstellen
$home = new home();
// Methode aufrufen, um die Countdown-Termine abzurufen
$appointments = $home->user_countdown();
// Überprüfen, ob der GET-Parameter 'event' vorhanden ist und ob er den Wert 'user_countdown' hat
if (isset($_GET['event']) && $_GET['event'] == 'user_countdown') {
    // Anzahl der Termine zählen
    $count = count($appointments);
    ?>
 <!-- Verstecktes Feld, um die Anzahl der Termine zu speichern -->
    <div type="hidden" id="count" value="<?php echo $count ?>"></div>
        <!-- Grid-Container für die Anzeige der Countdown-Termine -->
    <div class="grid-container">

        <?php foreach ($appointments as $row) {
            ?>
            <!-- Link zum Bearbeiten des Termins -->
            <a href='index.php?page=appointment&event=user_editappointment&id=<?php echo $row['id']; ?>' style='text-decoration: none'>
            <!-- Grid-Element für jeden Termin -->
                <div class="grid-item" title="<?php echo $row['description'] ?>">
               <!-- Verstecktes Feld, um das Startdatum und die Zeit des Termins zu speichern -->
                <div type="hidden" id="datetime_star" value="<?php echo $row['date_star']; ?>"></div>
 <!-- Anzeige des Startdatums des Termins -->
                <div id="day"><?php echo date("m/d/Y", strtotime($row['date_star'])); ?></div>
                <!-- Anzeige des Namens des Termins -->
                <div class="name"><?php echo $row['name']; ?></div>
                 <!-- Anzeige des Countdowns für Tage, Stunden, Minuten und Sekunden -->
                <div id="days" class="time" >00</div>
                <div class="time">&nbsp;Days&nbsp;</div>
                <div id="hours" class="time">00</div>
                <div class="time">&nbsp;Hrs&nbsp;</div>
                <div id="minutes" class="time">00</div>
                <div class="time">&nbsp;Min&nbsp;</div>
                <div id="seconds" class="time">00</div>
                <div class="time">&nbsp;Sec</div>
               
            </div>
             <!-- JavaScript, um den Countdown für jedes Grid-Element zu initialisieren -->
          
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var gridItems = document.querySelectorAll(".grid-item");
                    gridItems.forEach(function (gridItem) {
                        initializeCountdown(gridItem);
                    });
                });
            </script>
            </a>

        <?php }
        ?>

    </div> <?php
} else {
      // Wenn 'event' nicht 'user_countdown' ist, wird die Willkommensnachricht angezeigt
        ?>
    <h1>WILLKOMMEN</h1>
<?php } ?>
