<?php
//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once("functions.php");

 //hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("c4993aps2"); 

//via de get krijg ik een id mee die zet ik in een variable
$deleteId = $_GET['id'];

//ik kijk of er een post is van de delete form als dat zo is doe ik via een query de row met het $deleteid verwijderen daarna stuur ik hem terug naar de vorige pagina en geef een action message mee
if(isset($_POST['deleteArticle'])){
    mysqli_query($connection, "DELETE FROM users WHERE id = ".$deleteId."");
    header("location: home.php?page=users&action=product_deleted");
}




?>

<div class="delete">
    <h2>weet u zeker dat u gerbuiker:
        <?= $deleteId ?> wilt verwijderen?
    </h2>
    <form method="post" name="deleteArticle">
        <input type="hidden" name="deleteArticle" value="1">
        <input type="hidden" name="editId" value="<?= $deleteId; ?>">
        <input class="button cancel" type="button" value="annuleer" onclick="window.location.href='?page=products';"/>
        <input class="button btn-red" type="submit" value="verwijder">
    </form>
</div>

<footer>
    <link rel="stylesheet" href="./css/delete.css">
</footer>