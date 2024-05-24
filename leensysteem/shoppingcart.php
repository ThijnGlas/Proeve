<?php 


?>
<div class="form-container">
  <div class="formulier">
    <h2>uw winkelwagen</h2>
    <a href="?page=index.php&action=clear"><p>leeg uw winkelwagen</p></a>
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