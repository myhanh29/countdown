<?php  
require_once 'classes/database.php';
require_once 'classes/setappointment.php';
$db = new Database(); 
$conn = $db->connect(); 

if ($_GET['event'] == 'user_appointment') {
    // Display the form for creating a new appointment
    ?>
<h1>TERMIN ERSTELLEN</h1>
<form id="myappointment" action="index.php?page=appointment&event=user_appointment" method="post">
    <div>Name des Termins</div>
    <input type="text" name="terminname" id="terminname" >
    <div>Beschreibung</div>
    <textarea id="description" name="description" rows="6" cols="50">Bitte geben Sie die Beschreibung für den Termin</textarea>
    <div>Geben Sie bitte das Datum und die Zeit nacheinander ein: </div>
    <input type="datetime-local" name="datetime" id="datetime">  <br>
    <label>Ist dieser Termin aktiv?</label>
    <input type="hidden" name="isactive" name="isactive" value="0" />
    <input type="checkbox" name="isactive" name="isactive" value="1" />
    <br>    <br>
    <button type="submit">Einreichen</button>
</form>
<?php
} else if($_GET['event'] == 'user_editappointment')
{      
    $id=$_GET['id'];
    $query = "SELECT * FROM appointment WHERE id=$id";
    $query_run = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($query_run)>0) {
        foreach($query_run as $row)
        {
        ?>
<h1>TERMIN BEARBEITEN</h1>
<form id="myappointment" action="index.php?page=appointment&event=user_editappointment" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <div>Name des Termins</div>
     <input type="text" name="edit_terminname" value="<?php echo $row['name'] ?>" class="form-control">
    <div>Beschreibung</div>
    <textarea id="description" name="edit_description" rows="6" cols="50" class="form-control"><?php echo $row['description']; ?></textarea>
    <div>Geben Sie bitte das Datum und die Zeit nacheinander ein: </div>
    <input type="datetime-local" name="edit_datetime" value="<?php echo date('Y-m-d\TH:i', strtotime($row['date'])); ?>" class="form-control">
    <br>
    <label>Ist dieser Termin aktiv?</label>
    <input type="hidden" name="edit_isactive" value="0" />
    <input type="checkbox" name="edit_isactive" value="1" <?php if ($row['is_active']=='1') echo 'checked'; ?>/>

    <br>    <br>
    <button type="submit">Einreichen</button>
</form> 
<?php 
}
    }
}
    
    ?>
