document.addEventListener('DOMContentLoaded', function() {
    // Benutzen local storage, um den Hintergrund zu spreichern
    var savedBackground = localStorage.getItem('background');
    if (savedBackground) {
        document.body.style.backgroundImage = "url('" + savedBackground + "')";
    }

    // Nehmen Information von abgegebener Form
    document.getElementById('mychange').addEventListener('submit', function(event) {
        event.preventDefault(); 
        changebackground();
    });

    // Ändern Hintergrund Funktion
    function changebackground() {
        var url = document.getElementById('bgchanger').value;
        document.body.style.backgroundImage = "url('" + url + "')";
        localStorage.setItem('background', url); // Speichern neuen Hintergrund zu local storage
    }
});
