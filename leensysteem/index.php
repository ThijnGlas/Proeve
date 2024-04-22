<?php
//hier haal ik een functie op die ik gebruik om een database connectie te maken
require ("./dashboard/functions.php");

//hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog");

//hier maak ik een lege variable aan die ik aanpas via een get zo kan ik berichten meegeven over wat er gebeurd
$message = "";
//in deze if statement kijk ik of er een page is in de url via get
if (array_key_exists('page', $_GET)) {
    //hier check ik naar welke pagina ik moet gaan via de get die ik mee geef via header('location')
    $include_page = $_GET['page'];
    if (!file_exists($include_page . ".php")) {
        $include_page = "pagenotfound";
    }
} else {
    $include_page = "products";
}

?>

<html>

<head>
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <div class="navBar">
        <img class="navBarLogo" src="./img/primary-logo.png" alt="Mediacollege-Logo" />
        <div class="navBarRight">
            <img src="./img/cart-shopping-solid 2.png" alt="Shoppingcart-Icon" />
            <div class="searchBar">
                <form action="?page=products" method="post">
                    <input class="id-zoek" name="zoekenInput" type="text" placeholder="zoeken met id">
                    <input type="hidden" name="zoekenId" value="1">
                </form>
            </div>
        </div>
    </div>

    <?php
    include ($include_page . ".php");
    ?>

    <div class="footer">
        <h3>Beheerders op school</h3>
        <p>Juda Hensen</p>
        <p>Silvan Herrema</p>
    </div>

</body>

</html>