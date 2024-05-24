<?php

//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once ("functions.php");

//hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("c5831Leensysteem");


//eerst check ik of er een post is gemaakt.
if (isset($_POST['toevoegenForm'])) {

    //print_r($_FILES); die();

    //print_r($_FILES);

    //dan kijk ik of er een editId is in de post en of die leeg is
    if (array_key_exists('editId', $_POST) && trim($_POST['editId']) == "") {
        //als dat zo is zet ik dit de values van de post in mijn database ik gebruik mysqli_real_escape_string zodat ik geen sql injectie krijg als er een error is heb ik die($connection) zodat ik een error message krijg daarna stuur ik de gebruiker terug met header(location) met daarin de action article_added zodat ik die kan gebruiken voor de message in de cms

        mysqli_query(
            $connection,
            "INSERT INTO users 
    (username, password, voornaam, achternaam, email, role_id)
    values
    ('" . mysqli_real_escape_string($connection, $_POST['usernameInput']) . "', 
    '" . hash('sha256', mysqli_real_escape_string($connection, $_POST['passwordInput'])) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['voornaamInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['achternaamInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['emailInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['roleidInput']) . "' 
    )"
        ) or die(mysqli_error($connection));
        header("location: home.php?page=users&action=user_added");

    } else {

        //als ik wel een editId mee krijg zet ik dit de values van de post in mijn database met een update where id editId ik gebruik hier ook mysqli_real_escape_string zodat ik geen sql injectie krijg als er een error is heb ik die($connection) zodat ik een error message krijg daarna stuur ik de gebruiker terug met header(location) met daarin de action article_updated zodat ik die kan gebruiken voor de message in de cms
        mysqli_query(
            $connection,
            "UPDATE products SET 
      username =  '" . mysqli_real_escape_string($connection, $_POST['usernameInput']) . "', 
      password = '" .  mysqli_real_escape_string($connection, $_POST['passwordInput']) . "', 
      voornaam = '" . mysqli_real_escape_string($connection, $_POST['voornaamInput']) . "',
      achternaam = '" . mysqli_real_escape_string($connection, $_POST['achternaamInput']) . "',
      email = '" . mysqli_real_escape_string($connection, $_POST['emailInput']) . "',
      role_id = '" . mysqli_real_escape_string($connection, $_POST['roleidInput']) . "'
      WHERE id = '" . $_POST['editId'] . "' LIMIT 1
      "
        ) or die(mysqli_error($connection));


        header("location: home.php?page=users&action=user_updated");
    }
}

//ik kijk hier of er een id is met get die zet ik in de $editId hiermee kan ik in mijn database kijken wat er allemaal al qua values instaan zodat het makkelijk aan te passen is als je op een artikel klik
if (array_key_exists('id', $_GET)) {
    $editId = $_GET['id'];
    $trashcan = 1;
    //SQL query voor ophalen informatie
    $get_product = mysqli_query($connection, "SELECT * FROM users WHERE id = '" . $editId . "' LIMIT 1") or die(mysqli_error($connection));

    while ($product = mysqli_fetch_array($get_product)) {
        $usernameInput = $product['username'];
        $passwordInput = $product['password'];
        $voornaamInput = $product['voornaam'];
        $achternaamInput = $product['achternaam'];
        $emailInput = $product['email'];
        $roleidInput = $product['role_id'];
    }
}
//als er geen editId is krijg je de lege values terug
else {
    $usernameInput = "";
    $passwordInput = "";
    $voornaamInput = "";
    $achternaamInput = "";
    $emailInput = "";
    $roleidInput = "";
}


?>
<a href="?page=users">
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
                            <label for="username">gebruikersnaam:</label>
                            <input id="username" type="text" name="usernameInput" value="<?= $usernameInput; ?>">
                        </div>
                    </td>
                    <td>
                        <div>
                            <label for="password">wachtwoord:</label>
                            <input id="password" type="password" name="passwordInput" value="<?= $passwordInput; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <label for="voornaam">voornaam:</label>
                            <input id="voornaam" type="text" name="voornaamInput" value="<?= $voornaamInput; ?>">
                        </div>
                    </td>
                    <td>
                        <div>
                            <label for="achternaam">achternaam:</label>
                            <input id="achternaam" type="text" name="achternaamInput" value="<?= $achternaamInput; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <label for="email">Email:</label>
                            <input id="email" type="email" name="emailInput" value="<?= $emailInput; ?>">
                        </div>
                    </td>
                    <td>
                        <div>
                            <label for="roleId">Role id:</label>
                            <input class="roleId" id="roleid" type="number" name="roleidInput" value="<?= $roleidInput; ?>">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="button-center">
            <input class="button post-btn" value="product toevoegen / aanpassen" type="submit">
            <?php 
                if($trashcan === 1){
                    echo"            
                    <a href=\"?page=deleteuser&id=".$editId."\"><img src=\"./img/trashcan.png\" alt=\"\"></a>
                    ";
                }
            ?>
        </div>
    </form>
</div>

<footer>
    <link rel="stylesheet" href="./css/addEdit.css">
</footer>