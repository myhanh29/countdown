<?php
// Neue Instanz der Klasse 'appointmentlist' erstellen
$appointmentlist = new appointmentlist();
// Methode aufrufen, um die Liste der Termine abzurufen
$appointments = $appointmentlist->user_appointmentlist();
?>
<!-- Bereich zur Anzeige der Terminliste -->
<div id="appointmentlist" style='display: flex; justify-content: center;'>
    <table style="margin-top:0px; text-align: center;" border='1' cellspacing='10' width='80%' bgcolor='#E8E8E8'> 
        <!-- Tabellenkopf mit Spaltenüberschriften -->
        <tr>
            <td width=100 style='font-weight: bold;'>Id</td> 
            <td width=100 style='font-weight: bold;'>Name</td> 
            <td width=100 style='font-weight: bold;'>Beschreibung</td> 
            <td width=100 style='font-weight: bold;'>Datum(star)</td> 
            <td width=100 style='font-weight: bold;'>Datum(end)</td> 
            <td width=100 style='font-weight: bold;'>Aktiver Status</td> 
            <td width=100 style='font-weight: bold;'>Priorität</td> 
            <td width=100 style='font-weight: bold;'>Benutzername</td> 
            <td width=100 style='font-weight: bold;'>Aktion</td> 
        </tr>
        <!-- Schleife zur Darstellung der Termininformationen -->
<?php foreach ($appointments as $row) { ?>

            <tr>
                <!-- Anzeige der Termininformationen in den entsprechenden Spalten -->
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo date("m/d/Y H:i:s", strtotime($row['date_star'])); ?></td>
                <td><?php echo date("m/d/Y H:i:s", strtotime($row['date_end'])); ?></td>
                <td><?php echo $row['is_active'] == '1' ? '&checkmark;' : ' '; ?> </td>
                <td><?php
                // Priorität anzeigen
                    $selected_priority = $row['priority'];
                    $priorities = array(
                        'normal' => 'Normal',
                        'Important' => 'Wichtig',
                        'unimportant' => 'Unwichtig'
                    );

                    $selected_label = $priorities[$selected_priority];
                    echo $selected_label;
                    ?></td>
                <td><?php echo $row['firstname']; ?> </td>
                <td>
                    <!-- Links zum Bearbeiten und Löschen des Termins -->
                    <a href='index.php?page=appointment&event=user_editappointment&id=<?php echo $row['id']; ?>' style='background-color: #fff2e6;border: 1px solid black; text-decoration: none; color: black;'>Bearbeiten</a>
                    <br>
                    <a href='index.php?page=appointment&event=user_deleteappointment&id=<?php echo $row['id']; ?>' onclick="myFunction()" style='background-color: #fff2e6;border: 1px solid black; text-decoration: none; color: black;'>Loeschen</a>
                </td>
            </tr>

        <?php } ?>
    </table>
</div>