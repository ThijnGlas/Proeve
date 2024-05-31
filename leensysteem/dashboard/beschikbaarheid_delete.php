<?php
include('dbconection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $sql = "DELETE FROM availabilities WHERE Fk_beheerder_Id = '$id'";
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM beheerder WHERE id = '$id'";
    mysqli_query($conn, $sql);
    header("location: http://29093.hosts2.ma-cloud.nl/Testing/leensysteem/dashboard/home.php?page=beschikbaarheid");
}
exit;