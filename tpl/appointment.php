<h1></h1>
<form id="myform" action="index.php?page=appointment&event=user_appointment" method="post">
    <div>Vorname</div>
    <input type="text" name="firstname" id="firstname" >
    <div>Description</div>
    <input type="text" name="description" id="description" >
    <div>Geben Sie bitte das Datum und die Zeit nacheinander ein: </div>
    <input type="datetime" name="datetime" id="datetime">
    <div>Ist dieser Termin aktiv? (1 für ja und 0 für nein) </div>
    <input type="number" name="isactive" id="isactive">
    <br>    <br>
    <button type="submit">Submit</button>
</form>

