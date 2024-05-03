/*
 * Diese Funktion zeigt ein Bestätigungsdialogfeld an, um den Benutzer zu fragen, ob er den Termin löschen möchte.
 * Wenn der Benutzer auf "OK" klickt, wird die Aktion ausgeführt.
 * Wenn der Benutzer auf "Abbrechen" klickt, wird die Standardaktion (das Löschen des Termins) verhindert.
 */
function myFunction() {
  if (confirm("Möchten Sie den Termin löschen?") == true) {
    
  } else {
     event.preventDefault();  
  }
}
/*
 * Diese Funktion zeigt ein Bestätigungsdialogfeld an, um den Benutzer zu fragen, ob er diesen Nutzer löschen möchte.
 * Wenn der Benutzer auf "OK" klickt, wird die Aktion ausgeführt.
 * Wenn der Benutzer auf "Abbrechen" klickt, wird die Standardaktion (das Löschen des Nutzers) verhindert.
 */
function myFunction1() {
  if (confirm("Möchten Sie diesen Nutzer löschen?") == true) {
    
  } else {
     event.preventDefault();  
  }
}

