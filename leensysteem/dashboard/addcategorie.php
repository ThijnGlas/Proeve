<?php

//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once ("functions.php");

//hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("c4993aps2");

//eerst check ik of er een post is gemaakt.
if (isset($_POST['toevoegenForm'])) {

    //print_r($_FILES); die();

    //print_r($_FILES);

    //dan kijk ik of er een editId is in de post en of die leeg is
    if (array_key_exists('editId', $_POST) && trim($_POST['editId']) == "") {
        //als dat zo is zet ik dit de values van de post in mijn database ik gebruik mysqli_real_escape_string zodat ik geen sql injectie krijg als er een error is heb ik die($connection) zodat ik een error message krijg daarna stuur ik de gebruiker terug met header(location) met daarin de action article_added zodat ik die kan gebruiken voor de message in de cms

        mysqli_query(
            $connection,
            "INSERT INTO categories 
    (name, description)
    values
    (
    '" . mysqli_real_escape_string($connection, $_POST['nameInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['descriptionInput']) . "'
    )"
        ) or die(mysqli_error($connection));

        header("location: home.php?page=categories&action=categorie_posted");

    } else {

        //als ik wel een editId mee krijg zet ik dit de values van de post in mijn database met een update where id editId ik gebruik hier ook mysqli_real_escape_string zodat ik geen sql injectie krijg als er een error is heb ik die($connection) zodat ik een error message krijg daarna stuur ik de gebruiker terug met header(location) met daarin de action article_updated zodat ik die kan gebruiken voor de message in de cms
        mysqli_query(
            $connection,
            "UPDATE categories SET 
      name = '" . mysqli_real_escape_string($connection, $_POST['nameInput']) . "', 
      description = '" . mysqli_real_escape_string($connection, $_POST['descriptionInput']) . "'
      WHERE id = '" . $_POST['editId'] . "' LIMIT 1
      "
        ) or die(mysqli_error($connection));


        header("location: home.php?page=categories&action=categorie_updated");
    }
}

//ik kijk hier of er een id is met get die zet ik in de $editId hiermee kan ik in mijn database kijken wat er allemaal al qua values instaan zodat het makkelijk aan te passen is als je op een artikel klik
if (array_key_exists('id', $_GET)) {
    $editId = $_GET['id'];
    $trashcan = 1;
    //SQL query voor ophalen informatie
    $get_category = mysqli_query($connection, "SELECT * FROM categories WHERE id = '" . $editId . "' LIMIT 1") or die(mysqli_error($connection));

    while ($category = mysqli_fetch_array($get_category)) {
        
        $nameInput = $category['name'];
        $descriptionInput = $category['description'];
    }
   
}
//als er geen editId is krijg je de lege values terug
else {
    $nameInput = "";
    $descriptionInput = "";
}


?>
<a href="?page=categories">
    <p class="terug"><- terug</p>
</a>
<div class="form-wrapper">
    <form class="toevoeg-frm" enctype="multipart/form-data" name="toevoegenForm" method="post">
        <input type="hidden" name="toevoegenForm" value="1">
        <input type="hidden" name="editId" value="<?= $editId; ?>">
        <table>
            <thead>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div>
                            <label for="name">Naam:</label>
                            <input id="name" type="text" name="nameInput" value="<?= $nameInput; ?>">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="description">
            <label for="description">beschrijving:</label>
            <textarea name="descriptionInput" id="description"><?= $descriptionInput; ?></textarea>
        </div>
        <div class="button-center">
            <input class="button post-btn" value="categorie toevoegen / aanpassen" type="submit">
            <?php
            if ($trashcan === 1) {
                echo "            
                    <a href=\"?page=deletecategorie&id=" . $editId . "\"><img src=\"./img/trashcan.png\" alt=\"\"></a>
                    ";
            }
            ?>
        </div>
    </form>
</div>

<footer>
    <link rel="stylesheet" href="./css/addEdit.css">
</footer>