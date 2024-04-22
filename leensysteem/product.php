<?php
    if (array_key_exists('id', $_GET)) {
        $editId = $_GET['id'];
        $trashcan = 1;
        //SQL query voor ophalen informatie
        $get_product = mysqli_query($connection, "SELECT * FROM products WHERE id = '" . $editId . "' LIMIT 1") or die(mysqli_error($connection));
    
        while ($product = mysqli_fetch_array($get_product)) {
            $name = $product['name'];
            $modelType = $product['model_type'];
            $maxAmount = $product['max_amount'];
            $description = $product['description'];
            $img = $product['img'];
        }
        // if(mysqli_num_rows($productsFromDatabase) == 0){
        //     header("location: home.php?page=products&action=product_notfound");
        // }
    }
    //als er geen editId is krijg je de lege values terug
    else {
        header("location: index.php?page=products");
    }
?>

<div class="omschrijving-container">
      <div class="omschrijving">
        <div class="image-container">
          <img src="./img/<?=$img?>" alt="<?= $product['name'];?>" />
        </div>

        <div class="content-container">
          <div class="spacer">
            <p>product</p>
            <h2><?= $name?></h2>
          </div>
          <div class="spacer">
            <p>model / type</p>
            <h2><?= $modelType?></h2>
          </div>
          <div class="spacer">
            <p>maximale aantal per keer lenen</p>
            <h2><?= $maxAmount?></h2>
          </div>
          <div class="spacer">
            <p>beschrijving</p>
            <h2><?= $description?></h2>
          </div>

          <div class="hoeveel-container">
            <div class="hoeveelContent-container">
              <p>hoeveel wil je er lenen?</p>
              <h2>1</h2>
            </div>

            <div class="hoeveel">
              <button class="button1">+</button>
              <button class="button2">-</button>
            </div>
          </div>
          <div class="button-container">
            <button class="button">In het winkelmandje</button>
          </div>
        </div>
      </div>
    </div>

    <footer>
        <link rel="stylesheet" href="./css/product.css">
    </footer>