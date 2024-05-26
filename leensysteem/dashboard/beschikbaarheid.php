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
    <form method="post"  id="bd">
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
                <label class="labels" for="md1">Ja</label>
                <input class="input" id="md1" type="radio" name="md" value="1" checked>
                <label class="labels" for="md2">Nee</label>
                <input class="input" id="md2" type="radio" name="md" value="0">
            <?php } else { ?>
                <label class="labels" for="md3">Ja</label>
                <input class="input" id="md3" type="radio" name="md" value="1">
                <label class="labels" for="md4">Nee</label>
                <input class="input" id="md4" type="radio" name="md" value="0" checked>
            <?php } ?>
            </div>

            <div class="day-container">
            <label class="input label" for="md">Dinsdag</label>
            <?php
            $Tuesday = $row3["Tuesday"];
            if ($Tuesday) {
                ?>
                <label class="labels" for="dd1">Ja</label>
                <input class="input" id="dd1" type="radio" name="dd" value="1" checked>
                <label class="labels" for="dd2">Nee</label>
                <input class="input" id="dd2" type="radio" name="dd" value="0">
            <?php } else { ?>
                <label class="labels" for="dd3">Ja</label>
                <input class="input" id="dd3" type="radio" name="dd" value="1">
                <label class="labels" for="dd4">Nee</label>
                <input class="input" id="dd4" type="radio" name="dd" value="0" checked>
            <?php } ?>
            </div>

            <div class="day-container">
            <label class="input label" for="md">Woensdag</label>
            <?php
            $Wednesday = $row3["Wednesday"];
            if ($Wednesday) {
                ?>
                <label class="labels" for="wd1">Ja</label>
                <input class="input" id="wd1" type="radio" name="wd" value="1" checked>
                <label class="labels" for="wd2">Nee</label>
                <input class="input" id="wd2" type="radio" name="wd" value="0">
            <?php } else { ?>
                <label class="labels" for="wd3">Ja</label>
                <input class="input" id="wd3" type="radio" name="wd" value="1">
                <label class="labels" for="wd4">Nee</label>
                <input class="input" id="wd4" type="radio" name="wd" value="0" checked>
            <?php } ?>
            </div>

            <div class="day-container">
            <label class="input label" for="md">Donderdag</label>
            <?php
            $Thursday = $row3["Thursday"];
            if ($Thursday) {
                ?>
                <label class="labels" for="drd1">Ja</label>
                <input class="input" id="drd1" type="radio" name="drd" value="1" checked>
                <label class="labels" for="drd2">Nee</label>
                <input class="input" id="drd2" type="radio" name="drd" value="0">
            <?php } else { ?>
                <label class="labels" for="drd3">Ja</label>
                <input class="input" id="drd3" type="radio" name="drd" value="1">
                <label class="labels" for="drd4">Nee</label>
                <input class="input" id="drd4" type="radio" name="drd" value="0" checked>
            <?php } ?>
            
            </div>
            <div class="day-container">
            <label class="input label" for="md">Vrijdag</label>
            <?php
            $Friday = $row3["Friday"];
            if ($Friday) {
                ?>
                <label class="labels" for="vd1">Ja</label>
                <input class="input" id="vd1" type="radio" name="vd" value="1" checked>
                <label class="labels" for="vd2">Nee</label>
                <input class="input" id="vd2" type="radio" name="vd" value="0">
            <?php } else { ?>
                <label class="labels" for="vd3">Ja</label>
                <input class="input" id="vd3" type="radio" name="vd" value="1">
                <label class="labels" for="vd4">Nee</label>
                <input class="input" id="vd4" type="radio" name="vd" value="0" checked>
            <?php } ?>
            </div>

            <button class="submitButton">Change</button>   
            </div>
        </form>
    </div>
<?php } ?>
</div>
<footer>
    <script src="./beschikbaarheid.js"></script>
</footer>