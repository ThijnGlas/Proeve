<?php

//hier haal ik een functie op die ik gebruik om een database connectie te maken
require ("./dashboard/functions.php");
function displayBeheerder()
{
    include ('dbconection.php');
    $day = date("l");
    $sql = "SELECT $day,Fk_beheerder_Id FROM availabilities WHERE $day = 1";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['Fk_beheerder_Id'];
        $sql2 = "SELECT * FROM beheerder WHERE id='$id'";
        $result2 = mysqli_query($conn, $sql2);
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo $row2['Naam'];
            echo "<br>";
        }
    }
}

//hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("c4993aps2");

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


if (isset($_POST["add_to_cart"])) {
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);

        $cart_data = json_decode($cookie_data, true);
    } else {
        $cart_data = array();
    }

    $item_id_list = array_column($cart_data, 'item_id');

    if (isset($_POST["add_to_cart"])) {
        if (isset($_COOKIE["shopping_cart"])) {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);

            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');

        if (in_array($_POST["hidden_id"], $item_id_list)) {
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $_POST["hidden_id"]) {
                    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
                }
            }
        } else {
            $item_array = array(
                'item_id' => $_POST["hidden_id"],
                'item_name' => $_POST["hidden_name"],
                'item_quantity' => $_POST["quantity"]
            );
            $cart_data[] = $item_array;
        }


        $item_data = json_encode($cart_data);
        setcookie('shopping_cart', $item_data, time() + (86400 * 30));
        header("location:index.php?success=1");
    }

}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        foreach ($cart_data as $keys => $values) {
            if ($cart_data[$keys]['item_id'] == $_GET["id"]) {
                unset($cart_data[$keys]);
                $item_data = json_encode($cart_data);
                setcookie("shopping_cart", $item_data, time() + (86400 * 30));
                header("location:index.php?page=shoppingcart&remove=1");
            }
        }
    }
    if ($_GET["action"] == "clear") {
        setcookie("shopping_cart", "", time() - 3600);
        header("location:index.php?page=shoppingcart&clearall=1");
    }
}

if (isset($_GET["notfound"])) {
    $message = '
 <div class="message remove-msg">
    <p>Geen product gevonden.</p>
 </div>
 ';
}

if (isset($_GET["success"])) {
    $message = '
 <div class="message succes-msg">
    <p>toegevoegd aan uw winkelwagen.</p>
 </div>
 ';
}

if (isset($_GET["remove"])) {
    $message = '
 <div class="message remove-msg">
    <p>verwijderd aan uw winkelwagen.</p>
 </div>
 ';
}


storeToBorrowed();

?>

<html>

<head>
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <div class="responsiveLogo">
        <a class="navbarB" href="?page=products"><img class="navBarLogo" src="./img/primary-logo.png" alt="Mediacollege-Logo" /></a>
    </div>
    <div class="navBar">
        <a class="navbarA" href="?page=products"><img class="navBarLogo" src="./img/primary-logo.png" alt="Mediacollege-Logo" /></a>
        <?= $message ?>
        <div class="navBarRight">
            <a href="index.php?page=shoppingcart"><img src="./img/cart-shopping-solid 2.png"
                    alt="Shoppingcart-Icon" /></a>
            <div class="searchBar">
                <form action="?page=products" method="post">
                    <input class="id-zoek" name="zoekenInput" type="text" placeholder="zoeken met naam">
                    <input type="hidden" name="zoekenId" value="1">
                </form>
            </div>
        </div>
    </div>
    <div class="main">
        <?php
        include ($include_page . ".php");
        ?>
    </div>
    <div class="footer">
        <h3>Beheerders op school</h3>
        <?php displayBeheerder(); ?>
    </div>


</body>

</html>