<?php
include ('dbconection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $md = $_POST['md'];
    $dd = $_POST['dd'];
    $wd = $_POST['wd'];
    $drd = $_POST['drd'];
    $vd = $_POST['vd'];
    $id = $_POST['id'];
    $sql2 = "UPDATE availabilities SET Monday = '$md', Tuesday = '$dd', Wednesday = '$wd', Thursday = '$drd', Friday = '$vd' WHERE Fk_beheerder_Id = '$id'";
    mysqli_query($conn, $sql2);
    header("Location: http://29093.hosts2.ma-cloud.nl/Testing/leensysteem/dashboard/home.php?page=beschikbaarheid");
}