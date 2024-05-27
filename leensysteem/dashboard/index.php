<?php
error_reporting(E_ALL); 


//hier haal ik een functie op die ik gebruik om een database connectie te maken
require("functions.php"); 

 //hier word een error message variable aangemaakt die aangepast word zodat er gemeld word wat er mis is
 $error_message = "";
 
 //hier zet ik de dbconnect functie in een $connection variable dit doe ik zodat ik hem makkelijk kan oproepen
 $connection = dbconnect('c5831Leensysteem');

//dit is de if statement die ik check om te kunnen inloggen in deze if statement geef ik cookies mee waar belangrijke informatie in word gezet zoals een session id
//eerst check ik of er een post is gemaakt door isset te gebruiken
if (isset($_POST['loginForm'])) {   
    //in deze if statement check ik of mijn username en password beide zijn gepost en of ze niet leeg zijn, hier gebruik ik ook een trim zodat er geen spaties in kunnen staan want als er een spatie in zou staan zou hij tellen als niet leeg terwijl hij dat wel is. als er niks is ingevuld komt er een errormessage die in de else staat
    if (array_key_exists('usernameInput', $_POST) && trim($_POST['usernameInput']) != "" && array_key_exists('passwordInput', $_POST) && trim($_POST['passwordInput'] != "")) {
        
        
        //in deze query check ik of mijn username en password wel in de database staan en als dat zo is word er 1 row in mijn checklogin gezet 
        $check_login = mysqli_query($connection, "SELECT * FROM users WHERE username = '" . mysqli_real_escape_string($connection, $_POST['usernameInput']) . "' AND password = '" . hash('sha256', mysqli_real_escape_string($connection, $_POST['passwordInput'])) . "' LIMIT 1");
        //hier check ik of er een row is bij gekomen als dat zo is redirect ik hem met header('location: ') ook geef ik cookies mee waarvan ik denk dat ze handig zijn maar de belangrijkste is session hier geef ik een uitleg van in mijn functions.php, als er er geen rows bijkomt komt er een errormessage die in de else staat
        if (mysqli_num_rows($check_login) == 1) {
            
            //hier geef ik mijn gegevens mee aan de user als cookies deze kan ik gaan gebruiken in mijn cms
            while($user = mysqli_fetch_array($check_login)){ 
                $user_id = $user['id'];
                setcookie("user_id", $user['id']);
                setcookie("firstname", $user['voornaam']); 
                setcookie("lastname", $user['achternaam']);
                setcookie("role_id", $user['role_id']);
            }
            $session = getRandomString(); 
            setcookie("session", $session);
            setcookie('ip', $_SERVER['REMOTE_ADDR']);
            mysqli_query($connection, "UPDATE users SET session = '".$session."', ipv4 = '". $_SERVER['REMOTE_ADDR']."' WHERE id = '".$user_id."'");
            header('location: home.php');
        } 
        else {
            $error_message = "the username or password is incorrect";
        }
    } else { 

        $error_message = "the username or password is not filled in";
    }
    
    } 

?>
<html>

<head>
<link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <main>
    <form name="loginForm" action="index.php" method="post">
      <div class="logo-container">
        <img src="img/primary-logo-2.png" alt="Logo" />
      </div>

      <input type="hidden" name="loginForm" value="1" />
      <h2><?= $error_message ?></h2>
      <div class="inputarea-container">
        <div class="label-container">
          <label for="username"><p>Gebruikersnaam</p></label>
          <input id="username" class="textarea" type="text" name="usernameInput" />
        </div>
        <div class="label-container">
          <label for="password"><p>Wachtwoord</p></label>
          <input id="password" class="textarea" type="password" name="passwordInput" />
        </div>

        <input class="submit-knop" value="Login" type="submit" />
      </div>

    </form>
  </main>
</body>
<footer>
<link rel="stylesheet" href="./css/login.css">
</footer>

</html>