<?php

//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once ("functions.php");

//hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("c4993aps2");

?>

<nav>
    <h1>Producten</h1>
    <a href="?page=addproduct">
        <p>product toevoegen</p>
    </a>
    <form action="?page=products" method="post">
        <input class="id-zoek" name="zoekenInput" type="text">
        <input type="hidden" name="zoekenId" value="1">
    </form>
</nav>
<div class="table-wrapper">
    <table class="table">
        <thead>
            <th><p>product</p></th>
            <th></th>
            <th><p>Model / type</p></th>
            <th><p>aantal</p></th>
            <th><p>ID</p></th>
            <th></th>
        </thead>
        <tbody>
        <?php 
            //in deze if statement check ik of er een post en of de post niet leeg is
            if(isset($_POST['zoekenInput']) && trim($_POST['zoekenInput']) != ""){ 
                //in deze query kijk ik of er artikels zijn waarvan de titel of het id in de database staat als beide niet waar zijn krijg je een message met daarin artikel niet gevonden.
                $productsFromDatabase = mysqli_query($connection, "SELECT * FROM products WHERE name LIKE '%".$_POST['zoekenInput']."%' OR id = '".$_POST['zoekenInput']."'") or die (mysqli_error($connection)); 
                if (mysqli_num_rows($productsFromDatabase) == 0) {
                    header("location: home.php?page=products&action=product_notfound");
                }
            } else {
                //als er niks is ingetypt krijg je alle artikels te zien
                $productsFromDatabase = mysqli_query($connection, "SELECT * FROM products ORDER BY id DESC");
            }
            //met deze while krijg ik alle artikels uit de database in een tabel. Ook staan er twee buttons in per row deze button geven een page en een id mee, in de files addarticles en deletearticles zie je wat er mee gedaan word
            while ($row = mysqli_fetch_array($productsFromDatabase)) {
                echo "
                <tr>
                <td class=\"title\" colspan=\"2\"><a href=\"?page=addproduct&id=".$row['id']."\"><p>" . $row['name'] . "</p></a></td>
                <td ><a href=\"?page=addproduct&id=".$row['id']."\"><p>" . $row['model_type'] . "</p></a></td>
                <td ><a href=\"?page=addproduct&id=".$row['id']."\"><p>" . $row['amount'] . "</p></a></td>
                <td ><a href=\"?page=addproduct&id=".$row['id']."\"><p>" . $row['id'] . "</p></a></td>
                <td class=button-w><a href=\"?page=addproduct&id=".$row['id']."\"><img src=\"./img/arrow-r.png\" alt=\"\"></a>
                </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

</div>


<footer>
    <link rel="stylesheet" href="./css/tablePage.css">
</footer>