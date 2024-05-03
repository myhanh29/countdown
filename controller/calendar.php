<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require_once 'classes/setcalendar.php';
require_once 'classes/setappointment.php';

class calendar {
//Methode für Ausdruckung von Kalender
    public function user_calendar() {
        $userid = $_SESSION['user']['id'];
        //Verwenden die Funktion appointmentlist() in setappointment.php, um Ereignisdaten abzurufen
        $setappointment = new setappointment();
        $appointments = $setappointment->appointmentlist($userid);
        //Verwenden die Funktion add_event in setcalender.php, um Ereignisse im Monatskalender anzuzeigen
        $setcalendar = new setcalendar();
        foreach ($appointments as $row) {
            $setcalendar->add_event($row['name'], date("Y-m-d H:i:s", strtotime($row['date_star'])), date("Y-m-d H:i:s", strtotime($row['date_end'])), $days = 1, $color = '', $row['priority']);
        }

        //Verwenden die Funktion __toString in setcalender.php, um den Kalender auf dem Bildschirm auszudrucken
        echo $setcalendar->__toString();
    }
}

