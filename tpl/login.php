
<h1>Anmelden</h1>
<form id="myform" action="index.php?page=login&event=user_login" method="post">
    <div>Email</div>
    <input type="text" name="email" id="email">
    <div>Passwort</div>
    <input type="password" name="password" id="password">
    <br>    <br>
    <a     href="index.php?page=resetRequest&event=user_reset"
           tabindex="0" 
    >Passwort vergessen / Probleme bei der Anmeldung</a>
    <br>    <br>
    <button type="submit">Einreichen</button>
</form>
