<?php
include ('dbconection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $md = $_POST['md'];
    $dd = $_POST['dd'];
    $wd = $_POST['wd'];
    $drd = $_POST['drd'];
    $vd = $_POST['vd'];
    if($md == "on"){
        $md = 1;
    }else{
        $md = 0;
    }

    if($dd == "on"){
        $dd = 1;
    }else{
        $dd = 0;
    }

    if($wd == "on"){
        $wd = 1;
    }else{
        $wd = 0;
    }

    if($drd == "on"){
        $drd = 1;
    }else{
        $drd = 0;
    }

    if($vd == "on"){
        $vd = 1;
    }else{
        $vd = 0;
    }
    $id = $_POST['id'];
    $sql2 = "UPDATE availabilities SET Monday = '$md', Tuesday = '$dd', Wednesday = '$wd', Thursday = '$drd', Friday = '$vd' WHERE Fk_beheerder_Id = '$id'";
    mysqli_query($conn, $sql2);
    header("Location: https://30639.hosts1.ma-cloud.nl/leensysteem/dashboard/home.php?page=beschikbaarheid");
}