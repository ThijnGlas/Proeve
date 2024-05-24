<?php


function displayBeheerder(){
    include ('dbconnection.php');
    $day = date("l");
    $sql = 'SELECT * FROM availabilities';
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        if($row["$day"]){
            $id = $row['Fk_beheerder_Id'];
            $sql2 = "SELECT * FROM beheerder WHERE id='$id'";
            $result = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result);
            echo $row2['Naam'];
        }
    }
}

?>