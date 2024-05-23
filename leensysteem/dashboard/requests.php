<?php

//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once ("functions.php");

//hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("c5831Leensysteem");

?>

<nav>
    <h1>Aanvragen</h1>
    <form action="?page=requests" method="post">
        <input class="id-zoek" placeholder="zoek op naam/schoolnummer/id" name="zoekenInput" type="text">
        <input type="hidden" name="zoekenId" value="1">
    </form>
</nav>
<div class="table-wrapper">
    <table class="table">
        <thead>
            <th><p>naam</p></th>
            <th></th>
            <th><p>schoolnummer</p></th>
            <th><p>datum aanvraag</p></th>
            <th></th>
        </thead>
        <tbody>
        <?php 
            //in deze if statement check ik of er een post en of de post niet leeg is
            if(isset($_POST['zoekenInput']) && trim($_POST['zoekenInput']) != ""){ 
                //in deze query kijk ik of er artikels zijn waarvan de titel of het id in de database staat als beide niet waar zijn krijg je een message met daarin artikel niet gevonden.
                $requestsFromDatabase = mysqli_query($connection, "SELECT * FROM borrow WHERE name LIKE '%".$_POST['zoekenInput']."%' OR id = '".$_POST['zoekenInput']."' OR schoolnumber = '".$_POST['zoekenInput']."'") or die (mysqli_error($connection)); 
                if (mysqli_num_rows($requestsFromDatabase) == 0) {
                    header("location: home.php?page=requests&action=requests_notfound");
                }
            } else {
                //als er niks is ingetypt krijg je alle artikels te zien
                $requestsFromDatabase = mysqli_query($connection, "SELECT * FROM borrow ORDER BY id DESC");
            }
            //met deze while krijg ik alle artikels uit de database in een tabel. Ook staan er twee buttons in per row deze button geven een page en een id mee, in de files addarticles en deletearticles zie je wat er mee gedaan word
            while ($row = mysqli_fetch_array($requestsFromDatabase)) {
                if($row['date_tobereturned'] == 0000-00-00){ 
                    echo "
                    <tr >
                    <td class=\"title nnbekeken\" colspan=\"2\"><p>" . $row['name'] . "</p></td>
                    <td ><p>" . $row['schoolnumber'] . "</p></td>
                    <td ><p>Aangevraagd op " . $row['date_requested'] . "</p></td>
                    <td class=button-w><a href=\"?page=request&id=".$row['id']."\"><img src=\"./img/arrow-r.png\" alt=\"\"></a>
                    </td>
                    </tr>";
                }

                // if(!$row['date_denied'] == 0000-00-00){ 
                //     echo "
                //     <tr >
                //     <td class=\"title \" colspan=\"2\"><p>" . $row['name'] . "</p></td>
                //     <td ><p>" . $row['schoolnumber'] . "</p></td>
                //     <td ><p>Aangevraagd op " . $row['date_requested'] . "</p></td>
                //     <td class=button-w><a href=\"?page=request&id=".$row['id']."\"><img src=\"./img/arrow-r.png\" alt=\"\"></a>
                //     </td>
                //     </tr>";
                // }
                else{
                    echo "
                    <tr>
                    <td class=\"title\" colspan=\"2\"><p>" . $row['name'] . "</p></td>
                    <td ><p>" . $row['schoolnumber'] . "</p></td>
                    <td ><p>Aangevraagd op " . $row['date_requested'] . "</p></td>
                    <td class=button-w><a href=\"?page=request&id=".$row['id']."\"><img src=\"./img/arrow-r.png\" alt=\"\"></a>
                    </td>
                    </tr>";
    
                }
            }
            ?>
        </tbody>
    </table>

</div>


<footer>
    <link rel="stylesheet" href="./css/tablePage.css">
</footer>