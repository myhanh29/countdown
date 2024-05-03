
<h1>CONFIG ERGÄNZEN</h1>
<form id="myconfig" action="install.php?page=fillconfig&event=user_fillconfig" method="post">
    <!-- Alle Konfigurationen werden ausgefüllt -->
      <label for="dbserver">Database Server:</label>
        <input type="text" id="dbserver" name="dbserver" required><br><br>
        
        <label for="dbuser">Database User:</label>
        <input type="text" id="dbuser" name="dbuser" required><br><br>
        <!-- Passwort ist optional -->
        <label for="dbpass">Database Password:</label>
        <input type="password" id="dbpass" name="dbpass"><br><br>
        
        <label for="dbname">Database Name:</label>
        <input type="text" id="dbname" name="dbname" required><br><br>
        
        <input type="submit" value="Konfiguration speichern">
</form>
