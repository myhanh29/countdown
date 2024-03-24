<h1>TERMIN ERSTELLEN</h1>
<form id="myform" action="index.php?page=appointment&event=user_appointment" method="post">
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
    <button type="submit">Submit</button>
</form>

