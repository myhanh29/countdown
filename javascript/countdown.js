/*
 * Diese Funktion initialisiert einen Countdown-Timer innerhalb eines Rasters (Grid-Element).
 * Sie berechnet die verbleibende Zeit zwischen dem aktuellen Datum und dem Enddatum,
 * und aktualisiert dann die HTML-Elemente, die Tage, Stunden, Minuten und Sekunden anzeigen,
 * alle Sekunde, bis der Countdown null erreicht.
 */
function initializeCountdown(gridItem) {
    var endDateString = gridItem.querySelector("#datetime_star").getAttribute("value");
    var endDate = new Date(endDateString);
    var startDate = new Date();
    var distance = endDate.getTime() - startDate.getTime();

    distance = parseInt(distance / 1000);
    //repeatCall();
    var intervalID = setInterval(repeatCall, 1000);
    function repeatCall() {
        distance = distance - 1;
        if (distance < 0) {
            clearInterval(intervalID);
            return;
        }

        var day = getDays(distance);
        var resultDiv = gridItem.querySelector("#days");
        resultDiv.innerHTML = day;
        var remainder = distance - day * (60 * 60 * 24);
        var hour = getHours(remainder);
        var resultDiv1 = gridItem.querySelector("#hours");
        resultDiv1.innerHTML = hour;
        var remainder2 = remainder - hour * (60 * 60);
        var min = getMin(remainder2);
        var resultDiv2 = gridItem.querySelector("#minutes");
        resultDiv2.innerHTML = min;
        var remainder3 = remainder2 - min * 60;
        var resultDiv3 = gridItem.querySelector("#seconds");
        resultDiv3.innerHTML = remainder3;
    }

    function getDays(seconds) {
        var day = seconds / (60 * 60 * 24);
        return parseInt(day);
    }

    function getHours(seconds)
    {
        var hour = seconds / (60 * 60);
        return parseInt(hour);
    }

    function getMin(seconds)
    {
        var min = seconds / 60;
        return parseInt(min);
    }
}
