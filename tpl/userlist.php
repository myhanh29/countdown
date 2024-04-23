
<?php
require_once 'classes/database.php';
require_once 'classes/createuserlist.php';
$db = new Database();
$conn = $db->connect();
if ($_GET['event'] == 'admin_userlist') {
    $userlist = new userlist();
    $users = $userlist->admin_userlist();
    ?>

    <div id="userlist" style='display: flex; justify-content: center;'>
        <table style="margin-top:0px; text-align: center;" border='1' cellspacing='10' width='80%' bgcolor='#E8E8E8'> 
            <tr>
                <td width=100 style='font-weight: bold;'>Id</td> 
                <td width=100 style='font-weight: bold;'>Vorname</td> 
                <td width=100 style='font-weight: bold;'>Nachname</td> 
                <td width=100 style='font-weight: bold;'>Email</td> 
                <td width=100 style='font-weight: bold;'>Passwort</td> 
                <td width=100 style='font-weight: bold;'>Rolle des Verwalters</td> 
                <td width=100 style='font-weight: bold;'>Aktion</td> 
            </tr>
            <?php foreach ($users as $row) { ?>

                <tr>
                    <td style='font-weight: normal;'><?php echo $row['id']; ?></td>
                    <td style='font-weight: normal;'><?php echo $row['firstname']; ?></td>
                    <td style='font-weight: normal;'><?php echo $row['lastname']; ?></td>
                    <td style='font-weight: normal;'><?php echo $row['email']; ?></td>
                    <td style='font-weight: normal;'><?php echo $row['PASSWORD']; ?></td>
                    <td style='font-weight: normal;'><?php echo $row['adminrole']; ?> </td>
                    <td style='font-weight: normal;'>
                        <a href='index.php?page=userlist&event=admin_edituser&id=<?php echo $row['id']; ?>' style='background-color: #fff2e6;border: 1px solid black; text-decoration: none; color: black;'>Bearbeiten</a>
                        <br>
                        <a href='index.php?page=userlist&event=admin_deleteuser&id=<?php echo $row['id']; ?>' onclick="myFunction1()" style='background-color: #fff2e6;border: 1px solid black; text-decoration: none; color: black;'>Loeschen</a>
                    </td>
                </tr>

            <?php } ?>
        </table>
    </div>
<?php } ?>
<?php
if ($_GET['event'] == 'admin_edituser') {
    $id = $_GET['id'];

    $query = "SELECT * FROM user WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
            <!-- Benutzerdatenbearbeitungsformular -->
            <h1>Benutzerdatenbearbeitung</h1>
            <form id="myform" action="index.php?page=userlist&event=admin_edituser" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div>Vorname</div>
                <input type="text" name="edit_firstname" id="firstname" value="<?php echo $row['firstname'] ?>">
                <div>Nachname</div>
                <input type="text" name="edit_lastname" id="lastname" value="<?php echo $row['lastname'] ?>">
                <div>Email</div>
                <input type="text" name="edit_email" id="email" value="<?php echo $row['email'] ?>">
                <div>Passwort</div>
                <input type="password" name="edit_password" id="password" value="<?php echo $row['PASSWORD']; ?>"><br>

                <label>Ist dieser Nutzer Admin?</label>
                <input type="hidden" name="edit_adminrole" value="0" />
                <input type="checkbox" name="edit_adminrole" value="1" <?php if ($row['adminrole'] == '1') echo 'checked'; ?>/>
                <br>    <br>
                <button type="submit">Einreichen</button>
            </form>
        <?php }
    }
} ?>