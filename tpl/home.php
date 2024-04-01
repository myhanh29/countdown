<?php
$home = new home();
$appointments = $home->user_countdown();
if (isset($_GET['event']) && $_GET['event'] == 'user_countdown') {
    $count = count($appointments);
    ?>
    <div type="hidden" id="count" value="<?php echo $count ?>"></div>
    <div class="grid-container">

        <?php foreach ($appointments as $row) {
            ?>
            <a href='index.php?page=appointment&event=user_editappointment&id=<?php echo $row['id']; ?>' style='text-decoration: none'>
            <div class="grid-item" title="<?php echo $row['description'] ?>">
              
                <div type="hidden" id="datetime" value="<?php echo $row['date']; ?>"></div>

                <div id="day"><?php echo date("m/d/Y", strtotime($row['date'])); ?></div>
                <div class="name"><?php echo $row['name']; ?></div>
                <div id="days" class="time" >00</div>
                <div class="time">&nbsp;Days&nbsp;</div>
                <div id="hours" class="time">00</div>
                <div class="time">&nbsp;Hrs&nbsp;</div>
                <div id="minutes" class="time">00</div>
                <div class="time">&nbsp;Min&nbsp;</div>
                <div id="seconds" class="time">00</div>
                <div class="time">&nbsp;Sec</div>
               
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var gridItems = document.querySelectorAll(".grid-item");
                    gridItems.forEach(function (gridItem) {
                        initializeCountdown(gridItem);
                    });
                });
            </script>
            </a>

        <?php }
        ?>

    </div> <?php
} else {
        ?>
    <h1>WILLKOMMEN</h1>
<?php } ?>
