<?php

//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once ("functions.php");

//hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog");

?>

<nav>

    <h1>products</h1>
    <a href="?page=addproduct">
            <p>product toevoegen</p>
    </a>
    <form action="?page=products" method="post">
        <input class="id-zoek" name="zoekenInput" type="text">
        <input type="hidden" name="zoekenId" value="1">
    </form>
</nav>

<footer>
    <link rel="stylesheet" href="./css/products.css">
</footer>