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
            "INSERT INTO products 
    (user_id, name, amount, model_type, max_amount, storage_id, img, description)
    values
    ('" . mysqli_real_escape_string($connection, $_COOKIE['user_id']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['nameInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['amountInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['modelTypeInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['maxamountInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['storageIDInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['imgInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['descriptionInput']) . "'
    )"
        ) or die(mysqli_error($connection));

        $uploads_dir = "../img/";
        if ($_FILES["imgInput"]["error"] == 0) {
          $tmp_name = $_FILES["imgInput"]["tmp_name"];
          $imgname = basename(mysqli_insert_id($connection) . "_" . $_FILES["imgInput"]["name"]);
    
          list($file, $ext) = explode(".", $imgname);
    
          if ($ext == "jpg" || $ext == "png") {
            move_uploaded_file($tmp_name, $uploads_dir . $imgname);
            mysqli_query($connection, "UPDATE products SET img = '" . $imgname . "' WHERE id = '" . mysqli_insert_id($connection) . "' LIMIT 1");
          } else {
            header("location: cms.php?page=articles&action=error");
          }
        }

        header("location: home.php?page=products&action=product_posted");

    } else {

        //als ik wel een editId mee krijg zet ik dit de values van de post in mijn database met een update where id editId ik gebruik hier ook mysqli_real_escape_string zodat ik geen sql injectie krijg als er een error is heb ik die($connection) zodat ik een error message krijg daarna stuur ik de gebruiker terug met header(location) met daarin de action article_updated zodat ik die kan gebruiken voor de message in de cms
        mysqli_query(
            $connection,
            "UPDATE products SET 
      user_id =  '" . mysqli_real_escape_string($connection, $_COOKIE['user_id']) . "', 
      name = '" .  mysqli_real_escape_string($connection, $_POST['nameInput']) . "', 
      amount = '" . mysqli_real_escape_string($connection, $_POST['amountInput']) . "',
      model_type = '" . mysqli_real_escape_string($connection, $_POST['modelTypeInput']) . "',
      max_amount = '" . mysqli_real_escape_string($connection, $_POST['maxamountInput']) . "',
      storage_id = '" . mysqli_real_escape_string($connection, $_POST['storageIDInput']) . "',
      description = '" . mysqli_real_escape_string($connection, $_POST['descriptionInput']) . "'
      WHERE id = '" . $_POST['editId'] . "' LIMIT 1
      "
        ) or die(mysqli_error($connection));

        $uploads_dir = "../img/";
        if ($_FILES["imgInput"]["error"] == 0) {
          $tmp_name = $_FILES["imgInput"]["tmp_name"];
          $imgname = $_POST['editId'] . "_" . $_FILES["imgInput"]["name"];
          if ((trim($_POST['oldImg']) != trim($imgname)) && trim($imgname) != "") {
    
            unlink("../img/".$_POST['oldImg']); 
    
            list($file, $ext) = explode(".", $imgname);
            if ($ext == "jpg" || $ext == "png") {
              move_uploaded_file($tmp_name, $uploads_dir . $imgname);
              mysqli_query($connection, "UPDATE products SET img = '" . $imgname . "' WHERE id = '" . $_POST['editId'] . "' LIMIT 1");
            } else {
              header("location: cms.php?page=products&action=error");
            }
          }
        }


        header("location: home.php?page=products&action=product_updated");
    }
}

//ik kijk hier of er een id is met get die zet ik in de $editId hiermee kan ik in mijn database kijken wat er allemaal al qua values instaan zodat het makkelijk aan te passen is als je op een artikel klik
if (array_key_exists('id', $_GET)) {
    $editId = $_GET['id'];
    $trashcan = 1;
    //SQL query voor ophalen informatie
    $get_product = mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $editId . "' LIMIT 1") or die(mysqli_error($connection));

    while ($product = mysqli_fetch_array($get_product)) {
        $nameInput = $product['name'];
        $amountInput = $product['amount'];
        $modelTypeInput = $product['model_type'];
        $maxamountInput = $product['max_amount'];
        $storageIDInput = $product['storage_id'];
        $imgInput = $product['img'];
        $descriptionInput = $product['description'];
    }
    // if(mysqli_num_rows($productsFromDatabase) == 0){
    //     header("location: home.php?page=products&action=product_notfound");
    // }
}
//als er geen editId is krijg je de lege values terug
else {
    $nameInput = "";
    $amountInput = "";
    $modelTypeInput = "";
    $maxamountInput = "";
    $storageIDInput = "";
    $imgInput = "";
    $descriptionInput = "";
}


?>
<a href="?page=products">
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
                    <td>
                        <div>
                            <label for="amount">Totaal aantal:</label>
                            <input id="amount" type="number" name="amountInput" value="<?= $amountInput; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <label for="modelType">model:</label>
                            <input id="modelType" type="text" name="modelTypeInput" value="<?= $modelTypeInput; ?>">
                        </div>
                    </td>
                    <td>
                        <div>
                            <label for="max">Maximale leen aantal:</label>
                            <input id="max" type="number" name="maxamountInput" value="<?= $maxamountInput; ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <label for="storageID">Storage ID:</label>
                            <input id="storageID" type="text" name="storageIDInput" value="<?= $storageIDInput; ?>">
                        </div>
                    </td>
                    <td>
                        <div>
                            <label for="heroimg">Foto:</label>
                            <input type="hidden" name="oldImg" value="<?= $imgInput; ?>">
                            <input class="imginput" id="heroimg" type="file" name="imgInput">
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
            <input class="button post-btn" value="product toevoegen / aanpassen" type="submit">
            <?php 
                if($trashcan === 1){
                    echo"            
                    <a href=\"?page=deleteproduct&id=".$editId."\"><img src=\"./img/trashcan.png\" alt=\"\"></a>
                    ";
                }
            ?>
        </div>
    </form>
</div>

<footer>
    <link rel="stylesheet" href="./css/addEdit.css">
</footer>