<?php
include ('dbconection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Naam = $_POST['Naam'];
    $sql2 = "INSERT INTO beheerder (Naam) VALUE ('$Naam')";
    mysqli_query($conn, $sql2);
    $last_id = mysqli_insert_id($conn);
    $sql4 = "INSERT INTO availabilities (Fk_beheerder_Id) VALUE ('$last_id')";
    mysqli_query($conn, $sql4);
    header("Location: https://30639.hosts1.ma-cloud.nl/leensysteem/dashboard/home.php?page=beschikbaarheid");

}