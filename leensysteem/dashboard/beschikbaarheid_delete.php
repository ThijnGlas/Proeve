<?php
include('dbconection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $sql = "DELETE FROM availabilities WHERE Fk_beheerder_Id = '$id'";
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM beheerder WHERE id = '$id'";
    mysqli_query($conn, $sql);
    header("location: home.php?page=beschikbaarheid");
}
exit;

?>