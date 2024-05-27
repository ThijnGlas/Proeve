<?php
//hier haal ik een functie op die ik gebruik om een database connectie te maken
require ("functions.php");

//hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog");

//hier doe ik een checklogin dit is een functie uit functions.php hier geef ik een uitleg van in mijn functions.php
check_login($_COOKIE['user_id'], $_COOKIE['session'], $_COOKIE['ip']);

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
    $include_page = "requests";
}

//in deze if statement kijk ik of er een action is in de url via get
if (array_key_exists('action', $_GET)) {
    //deze get gebruik ik om de message variable te veranderen. Zo kan ik makkelijk een message mee geven over wat er gebeurd in de cms zoals als een artikel word toegevoegd.
    if ($_GET['action'] == "article_posted") {
        $message = "<div class=\"message succesmessage\">Het artikel is toegevoegd</div>";
    } 
    elseif ($_GET['action'] == "article_updated") {
        $message = "<div class=\"message updatemessage\">Het artikel is geupdate</div>";
    }
}

updateborrow();
turnin();
?>
<html>

<head>
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <div class="sidemenu">
        <div class="img-container">
            <img src="./img/primary-logo.png" alt="">
        </div>
        <div>
            <ul>
                <a href="?page=requests">
                    <li>Aanvragen</li>
                </a>
                <a href="?page=products">
                    <li>Producten</li>
                </a>
                <a href="?page=users">
                    <li>Gebruikers</li>
                </a>
                <a href="?page=turnins">
                    <li>inleveren</li>
                </a>
                <a href="?page=beschikbaarheid">
                    <li>Beschikbaarheid</li>
                </a>
            </ul>
            <div class="buttons_user">
                <div class="user">
                    <img src="./img/user.png" alt="user">
                    <p>
                        <?= $_COOKIE['firstname'], " ", $_COOKIE['lastname'] ?>
                    </p>
                </div>
                <div class="avail">
                    <p>beschikbaar</p>
                </div>
                <div onclick="window.location.href='index.php';" class="logout">
                    <p>uitloggen</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="content">
            <?= $message ?>
            <?php include ($include_page . ".php"); ?>
        </div>
    </div>
</body>


</html>