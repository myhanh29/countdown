<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'classes/database.php';
require_once 'classes/setappointment.php';

class appointmentlist {

    public function user_appointmentlist() {

        $userid = $_SESSION["user"]["id"];
        // //Verwenden die Funktion appointmentlist() in setappointment.php, um Ereignisdaten abzurufen
        
        $setappointment = new setappointment();

        $appointments = $setappointment->appointmentlist($userid);
        //Zeitzone definieren
        date_default_timezone_set('Europe/Berlin');
        $today = date("Y-m-d H:i:s");// Ruft das aktuelle Datum und die aktuelle Uhrzeit im Format "Jahr-Monat-Tag Stunde:Minute:Sekunde" ab und speichert in der Variable $today.

        foreach ($appointments as $row) {
            //Weisen der Variablen $appointmentdate die Endzeit des Ereignisses zu
            $appointmentdate = date("Y-m-d H:i:s", strtotime($row['date_end']));
//Wenn die aktuelle Zeit größer als die Endzeit des Ereignisses ist, wird das Ereignis automatisch gelöscht
            if ($appointmentdate < $today) {

                $setappointment = new setappointment();
                $setappointment->deleteappointment($row['id']);
            }
        }

//Neues Array ohne überfällige Ereignisse
        return $appointments;
    }
}
