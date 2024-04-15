<?php
//in de functie dbconnect geef ik de nodige gegevens mee in de eerste 3 variable ook krijgt de functie een database naam mee dit doe ik wanneer ik hem oproep
function dbconnect($database)
{

    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";

    //dan gebruik ik mysqli_connect om te connecten aan de database
    $connection = mysqli_connect($db_server, $db_username, $db_password);
    //daarna doe ik een mysqli_select_db hiermee selecteer ik in welke database ik wil en deze returned dan een connection

    $database = "c5831leensysteem";
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
