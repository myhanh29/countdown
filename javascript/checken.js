/*
 * Dieses Skript überwacht das Absenden eines Formulars mit der ID 'myform'.
 * Es überprüft, ob das eingegebene Passwort mit der Passwortbestätigung übereinstimmt.
 * Wenn die Passwörter nicht übereinstimmen, wird eine Warnmeldung angezeigt und das Absenden des Formulars verhindert.
 * Es überprüft auch, ob alle erforderlichen Felder ausgefüllt sind.
 * Wenn nicht, wird eine Warnmeldung angezeigt und das Absenden des Formulars verhindert.
 */
document.getElementById('myform1').addEventListener('submit', function (event) {
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var password1 = document.getElementById('password1').value;
    if(password !== password1)
    {
        alert('Das Passwort ist nicht dasselbe!');
        event.preventDefault(); // Verhinderung der Übertragung von Formularen
    };
    if(firstname===null||firstname==='' &&lastname===null||lastname ===''&&email===null||email===''&&password===null||password===''&&password1===null||password1==='' ){
      alert('Informationen sind nicht 100% gegeben!');
       event.preventDefault();  
    }
    /* if(lastname===null||lastname ==='' ){
      alert('Lastname is not given!');
       event.preventDefault();  
    }
     if(email===null||email==='' ){
      alert('Email is not given!');
       event.preventDefault();  
    }
    if(password===null||password==='' ){
      alert('Password is not given!');
       event.preventDefault();  
    }
     if(password1===null||password1==='' ){
      alert('Password is not repeated!');
       event.preventDefault();  
    }*/
    
});

