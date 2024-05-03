<?php
// Einbindung der Dateien für die Datenbankverbindung und die Klasse 'setappointment'
require_once 'classes/database.php';
require_once 'classes/setappointment.php';
// Neue Instanz der Klasse 'Database' erstellen und Verbindung zur Datenbank herstellen
$db = new Database();
$conn = $db->connect();
// Überprüfen, ob der GET-Parameter 'event' vorhanden ist und ob er den Wert 'user_appointment' hat
if ($_GET['event'] == 'user_appointment') {
     // Formular zum Erstellen eines neuen Termins anzeigen
    ?>
    <h1>TERMIN ERSTELLEN</h1>
    <form id="myappointment" action="index.php?page=appointment&event=user_appointment" method="post">
        <div>Name des Termins</div>
        <input type="text" name="terminname" id="terminname" >
        <div>Beschreibung</div>
        <textarea id="description" name="description" rows="6" cols="50">Bitte geben Sie die Beschreibung für den Termin</textarea>
        <div>Geben Sie bitte den Starttag und die Zeit nacheinander ein: </div>
        <input type="datetime-local" name="datetime_star" id="datetime_star">  <br>
        <div>Geben Sie bitte den Endtag und die Zeit nacheinander ein: </div>
        <input type="datetime-local" name="datetime_end" id="datetime_end">  <br>
        <label>Bitte priorisieren Sie: </label>
        <select id="priority" name="priority">
            <option value="normal">Normal</option>
            <option value="Important">Wichtig</option>
            <option value="unimportant">Unwichtig</option>
        </select> <br>
        <label>Ist dieser Termin aktiv?</label>
        <input type="hidden" name="isactive" name="isactive" value="0" />
        <input type="checkbox" name="isactive" name="isactive" value="1" />
        <br>    <br>
        <button type="submit">Einreichen</button>
    </form>
    <?php
} else if ($_GET['event'] == 'user_editappointment') {
     // Wenn der GET-Parameter 'event' den Wert 'user_editappointment' hat, wird der Termin bearbeitet
    $id = $_GET['id'];
 // SQL-Abfrage, um die Termininformationen anhand der ID abzurufen
    $query = "SELECT * FROM appointment WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);
  // Überprüfen, ob die Abfrage Ergebnisse zurückgibt
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
      <!-- Formular zum Bearbeiten des Termins anzeigen -->
            <h1>TERMIN BEARBEITEN</h1>
            <form id="myappointment" action="index.php?page=appointment&event=user_editappointment" method="post">
                 <!-- Verstecktes Feld für die ID des Termins -->
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div>Name des Termins</div>
                <!-- Eingabefeld für den Namen des Termins mit vorherigem Wert -->
                <input type="text" name="edit_terminname" value="<?php echo $row['name'] ?>" class="form-control">
                <div>Beschreibung</div>
                <textarea id="description" name="edit_description" rows="6" cols="50" class="form-control"><?php echo $row['description']; ?></textarea>
                <div>Geben Sie bitte den Startage Zeit nacheinander ein: </div>
                <input type="datetime-local" name="edit_datetime_star" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date_star'])); ?>" class="form-control">
                <div>Geben Sie bitte den Endtag und die Zeit nacheinander ein: </div>
                <input type="datetime-local" name="edit_datetime_end" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date_end'])); ?>" class="form-control">

                <br>
                <?php
                   // Ausgewählte Priorität und Optionen für die Priorität anzeigen
                $selected_priority = $row['priority'];
                ?>
                <label>Bitte priorisieren Sie: </label>
                <select id="priority" name="edit_priority">
                    <?php
                    $priorities = array(
                        'normal' => 'Normal',
                        'Important' => 'Wichtig',
                        'unimportant' => 'Unwichtig'
                    );

                    foreach ($priorities as $value => $label) {
                        $selected = ($selected_priority == $value) ? 'selected' : '';
                        echo "<option value=\"$value\" $selected>$label</option>";
                    }
                    ?>
                </select> <br>
                  <!-- Checkbox für den Aktivitätsstatus des Termins mit vorherigem Wert -->
                <label>Ist dieser Termin aktiv?</label>
                <input type="hidden" name="edit_isactive" value="0" />
                <input type="checkbox" name="edit_isactive" value="1" <?php if ($row['is_active'] == '1') echo 'checked'; ?>/>

                <br>    <br>
                <button type="submit">Einreichen</button>
            </form> 
            <?php
        }
    }
}
?>
