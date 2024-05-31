
<?php
include ('dbconection.php');

$sql = "SELECT * FROM beheerder";
$result = mysqli_query($conn, $sql);
$sql3 = "SELECT * FROM availabilities";
$result2 = mysqli_query($conn, $sql3);
$availabilities = mysqli_fetch_all($result2, MYSQL_ASSOC);
$beheer_availabilities = array_column($availabilities, "Fk_beheerder_Id");

?>

<link rel="stylesheet" href="./css/beschikbaarheid.css">
<div class="mainsection">
    <form method="post" id="bd">
        <select name="id" onchange="availability_display()" class="dropdown" name="beheerder" id="beheerder">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {

                ?>
                <option class="selector" value="<?= $row['id'] ?>"><?= $row['Naam'] ?></option>

                <?php

            }
            ?>

        </select>
    </form>
    <form method="post" action="beschikbaarheid_handeling.php">
        <input class="dropdown dropdownInput" type="text" name="Naam" placeholder="Voeg beheerder toe">
        <button class="dropdown dropdownButton">Submit</button>
    </form>


</div>

<div class="dagen-container">
    <?php
    while ($row3 = mysqli_fetch_assoc($result2)) { ?>
        <div class="dagen" id="<?= $row3['Fk_beheerder_Id'] ?>">
            <form class="selection-container" method="post" action="change_handeling.php">

                <div class="border">
                    <div class="day-container">
                        <label class="input label" for="md">Maandag</label>
                        <input type="hidden" value="<?= $row3['Fk_beheerder_Id'] ?>" name="id">
                        <?php
                        $Monday = $row3["Monday"];
                        if ($Monday) {
                            ?>
                            <input id="md" type="checkbox" name="md" checked>
                        <?php } else { ?>
                            <input id="md" type="checkbox" name="md">
                        <?php } ?>
                    </div>

                    <div class="day-container">
                        <label class="input label" for="dd">Dinsdag</label>
                        <?php
                        $Tuesday = $row3["Tuesday"];
                        if ($Tuesday) {
                            ?>
                            <input id="dd" type="checkbox" name="dd" checked>
                        <?php } else { ?>
                            <input id="dd" type="checkbox" name="dd">
                        <?php } ?>
                    </div>

                    <div class="day-container">
                        <label class="input label" for="wd">Woensdag</label>
                        <?php
                        $Wednesday = $row3["Wednesday"];
                        if ($Wednesday) {
                            ?>
                            <input id="wd" type="checkbox" name="wd" checked>
                        <?php } else { ?>
                            <input id="wd" type="checkbox" name="wd">
                        <?php } ?>
                    </div>

                    <div class="day-container">
                        <label class="input label" for="td">Donderdag</label>
                        <?php
                        $Thursday = $row3["Thursday"];
                        if ($Thursday) {
                            ?>
                            <input id="td" type="checkbox" name="drd" checked>
                        <?php } else { ?>
                            <input id="td" type="checkbox" name="drd">
                        <?php } ?>

                    </div>
                    <div class="day-container">
                        <label class="input label" for="fd">Vrijdag</label>
                        <?php
                        $Friday = $row3["Friday"];
                        if ($Friday) {
                            ?>
                            <input id="fd" type="checkbox" name="vd" checked>
                        <?php } else { ?>
                            <input id="fd" type="checkbox" name="vd">
                        <?php } ?>
                    </div>

                    <button class="submitButton">Change</button>
                </div>
            </form>
            <form method="post" action="beschikbaarheid_delete.php">
                <input type="hidden" name="id" value="<?= $row3['Fk_beheerder_Id']?>" id="deleteBeheerderId">
                <button type="submit" class="deleteButton">Delete current user</button>
            </form>
        </div>
    <?php } ?>
</div>
<footer>
    <script src="./beschikbaarheid.js"></script>
</footer>
