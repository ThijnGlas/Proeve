<?php


?>
<div class="form-container">
  <div class="formulier">
    <h2>uw winkelwagen</h2>
    <a class="emptyCart" href="?page=index.php&action=clear">
      <p>leeg uw winkelwagen</p>
    </a>
    <div class="cartEntree-container">
      <div class="image-container">
        <input type="hidden">
      </div>
      <?php if (isset($_COOKIE["shopping_cart"])) {
            echo "<div class=\"content-container\">
            <p class=\"spacer\"> Product</p>
            <input type=\"hidden\">
            <p class=\"spacer3\">Aantal</p>
          </div>";
    
    }?>
    </div>
    <?php getProductsShoppingcart(); ?>
    <div class="button-container">
      <form action="index.php?page=request" name="sendRequest" method="post">
        <input type="submit" value="Stuur verzoek" class="button"></input>
      </form>
    </div>
  </div>
</div>
<footer>
  <link rel="stylesheet" href="./css/shoppingCart.css">
</footer>