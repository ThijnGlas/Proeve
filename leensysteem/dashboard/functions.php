<?php
//in de functie dbconnect geef ik de nodige gegevens mee in de eerste 3 variable ook krijgt de functie een database naam mee dit doe ik wanneer ik hem oproep
function dbconnect($database)
{

    $db_server = "127.0.0.1";
    $db_username = "c5831thijn";
    $db_password = "Th1jn-MA";

    //dan gebruik ik mysqli_connect om te connecten aan de database
    $connection = mysqli_connect($db_server, $db_username, $db_password);
    //daarna doe ik een mysqli_select_db hiermee selecteer ik in welke database ik wil en deze returned dan een connection

    $database = "c5831Leensysteem";
    mysqli_select_db($connection, $database);
    return $connection;


}

//in de check_login functie check ik de session id en maakt die vervolgens een nieuwe aan. ik geef via cookies een user_id, session id en het ip mee
function check_login($user_id, $session, $ipv4)
{
    //eerst maakt hij een database connectie zodat ik in de database de gegevens kan checken
    $dbconnection = dbconnect("c5831Leensysteem");
    //ik select alles via het userid 
    $check_login = mysqli_query($dbconnection, "SELECT * FROM users WHERE id = '" . $user_id . "' AND session = '" . $session . "' AND ipv4 = '" . $ipv4 . "' LIMIT 1");
    //deze if statement checkt of ik een row terug krijg
    if (mysqli_num_rows($check_login) == 1) {
        //als dat zo is geef ik een nieuwe sessionid mee aan de cookies en zet deze in de database
        $session = getRandomString();
        setcookie("session", $session);
        mysqli_query($dbconnection, "UPDATE users SET session = '" . $session . "' WHERE id = '" . $user_id . "'");
    }
    //als er geen row terugkomt van de check_login word hij meteen terug gestuurd naar het login scherm
    else {
        header("location: index.php");
        exit;
    }

}

function displayBeheerder()
{
    $connection = dbconnect("c5831Leensysteem");

    $day = date("l");


    // Controleer of de dagkolom bestaat in de database
    $sql = 'SHOW COLUMNS FROM availabilities LIKE "' . $day . '"';
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql = 'SELECT * FROM availabilities';
        $result = mysqli_query($connection, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row[$day]) {
                    $id = $row['Fk_beheerder_Id'];
                    $sql2 = "SELECT * FROM beheerder WHERE id='$id'";
                    $result2 = mysqli_query($connection, $sql2);
                    if ($result2) {
                        $row2 = mysqli_fetch_assoc($result2);
                        echo $row2['Naam'] . "<br>";
                    } else {
                        echo "Error in query: " . mysqli_error($connection);
                    }
                }
            }
        } else {
            echo "Error in query: " . mysqli_error($connection);
        }
    } else {
        echo "Column $day does not exist in availabilities table.";
    }

    // Verbinding met de database sluiten
    mysqli_close($connection);
}


//met deze functie maak ik een simpele string aan die ik mee kan geven als session id dit doe ik met random
function getRandomString()
{
    $n = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}


function getProductsShoppingcart()
{
    $connection = dbconnect("c5831Leensysteem");

    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        foreach ($cart_data as $keys => $values) {
            $get_productsc = mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $values["item_id"] . "' LIMIT 1") or die(mysqli_error($connection));
            while ($row = mysqli_fetch_array($get_productsc)) {
                ?>

                <div class="cartEntree-container cartEntree-border">
                    <div class="image-container image-border">
                         <img src="./img/<?= $row['img'] ?>" alt="">
                    </div>
                    <div class="content-container">
                        <p class="spacer"><?= $values['item_name'] ?></p>
                        <p class="spacer2"><?= $values['item_model'] ?></p>
                        <p class="spacer3"><?= $values['item_quantity'] ?></p>
                    </div>
                    <div class="hoeveel">
                        <a href="?page=shoppingcart&action=delete&id=<?php echo $row["id"]; ?>"><img src="./img/trashcan.png"
                                alt=""></a>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
    } else {
        echo "


        <tr>
            <td><p class=\"geen\" style=\"text-align: center;\">u heeft geen producten in uw winkelwagen</p></td>
        </tr>";

    }
}


function storeToBorrowed()
{
    $connection = dbconnect("c5831Leensysteem");
    if (isset($_POST['requestForm'])) {
        if (array_key_exists('nameInput', $_POST) && trim($_POST['nameInput']) != "" && array_key_exists('numberInput', $_POST) && trim($_POST['numberInput'] != "")) {
            if (isset($_COOKIE['shopping_cart'])) {
                // die(gmdate('d-m-y'));

                $cookie_data = $_COOKIE['shopping_cart'];
                $cart_data = json_decode($cookie_data, true);

                $products = $cart_data;
                $products_json = json_encode($products);

                mysqli_query(
                    $connection,
                    "INSERT INTO borrow 
                (name, schoolnumber, products, date_requested)
                VALUES
                ('" . mysqli_real_escape_string($connection, $_POST['nameInput']) . "', 
                '" . mysqli_real_escape_string($connection, $_POST['numberInput']) . "', 
                '" . mysqli_real_escape_string($connection, $products_json) . "', 
                '" . gmdate('y-m-d') . "'
                )"
                ) or die(mysqli_error($connection));
                header("location: index.php?page=requestsucces");
                setcookie("shopping_cart", "", time() - 3600);
            }
        }
    }
}

function updateborrow() {
    $connection = dbconnect("c5831Leensysteem");

    if (isset($_POST['requestupdateForm'])) {
        $get_borrow = mysqli_query($connection, "SELECT * FROM borrow WHERE id = '" . mysqli_real_escape_string($connection, $_POST['id']) . "' LIMIT 1") or die(mysqli_error($connection));

        if ($borrow = mysqli_fetch_assoc($get_borrow)) {
            $name = $borrow['name'];
            $schoolnumber = $borrow['schoolnumber'];
            $products = json_decode($borrow['products'], true);

            if (isset($_POST['accepted'])) {
                if ($_POST['date']) {
                    foreach ($products as $product) {
                        $product_id = $product['item_id'];
                        $product_quantity = $product['item_quantity'];
                        mysqli_query($connection, "UPDATE products SET amount = amount - $product_quantity WHERE id = '$product_id'");
                    }

                    mysqli_query(
                        $connection,
                        "UPDATE borrow SET 
                        date_tobereturned = '" . mysqli_real_escape_string($connection, $_POST['date']) . "', 
                        accepted = '1', 
                        declined = '0'
                        WHERE id = '" . mysqli_real_escape_string($connection, $_POST['id']) . "' LIMIT 1"
                    ) or die(mysqli_error($connection));
                    verstuur_mail($name, $schoolnumber, $_POST['date'], "", true);
                } else {
                    header("Location: home.php?page=request&id=" . $_POST['id'] . "&message=1");
                    exit;
                }
            } elseif (isset($_POST['declined'])) {
                $reason = isset($_POST['reason']) ? "Reden: " . $_POST['reason'] : "";
                mysqli_query(
                    $connection,
                    "UPDATE borrow SET 
                    declined = '1', 
                    accepted = '0'
                    WHERE id = '" . mysqli_real_escape_string($connection, $_POST['id']) . "' LIMIT 1"
                ) or die(mysqli_error($connection));
                verstuur_mail($name, $schoolnumber, $_POST['date'], $reason, false);
            }
        }
    }
}

function verstuur_mail($name, $schoolnumber, $returndate, $reason, $action)
{
    $afzender = "j.hensen@ma-web.nl";
    $ontvanger = $schoolnumber . "@ma-web.nl";
    $onderwerp = "Onderwerp van de e-mail";
    $bericht = "";

    if ($action) {
        $bericht = "
        Beste $name,
    
        Uw aanvraag is geaccepteerd en moet op $returndate ingeleverd worden.
    
        Met vriendelijke groet,
        Techlab
        ";
    } elseif (!$action) {
        $bericht = "
        Beste $name,
    
        Uw aanvraag is afgewezen op ".gmdate('d-m-y').". $reason
    
        Met vriendelijke groet,
        Techlab
        ";
    }

    $headers = "From: $afzender\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

    mail($ontvanger, $onderwerp, $bericht, $headers);
}

    function turnin() {
    $connection = dbconnect("c5831Leensysteem");

    if (isset($_POST['turninForm'])) {
        $get_borrow = mysqli_query($connection, "SELECT * FROM borrow WHERE id = '" . mysqli_real_escape_string($connection, $_POST['id']) . "' LIMIT 1") or die(mysqli_error($connection));

        if ($borrow = mysqli_fetch_assoc($get_borrow)) {
            $products = json_decode($borrow['products'], true);

            if (isset($_POST['accepted'])) {
                foreach ($products as $product) {
                    $product_id = $product['item_id'];
                    $product_quantity = $product['item_quantity'];
                    mysqli_query($connection, "UPDATE products SET amount = amount + $product_quantity WHERE id = '$product_id'");
                }

                mysqli_query(
                    $connection,
                    "UPDATE borrow SET 
                    date_returned = '" . gmdate('Y-m-d') . "' 
                    WHERE id = '" . mysqli_real_escape_string($connection, $_POST['id']) . "' LIMIT 1"
                ) or die(mysqli_error($connection));
                header("Location: home.php?page=turnins");

            }
        }
    }
}

?>