<?php
if (array_key_exists('id', $_GET)) {
    $editId = $_GET['id'];

    $get_borrow = mysqli_query($connection, "SELECT * FROM borrow WHERE id = '" . mysqli_real_escape_string($connection, $editId) . "' LIMIT 1") or die(mysqli_error($connection));
    
    if ($borrow = mysqli_fetch_assoc($get_borrow)) {
        $name = $borrow['name'];
        $schoolnummer = $borrow['schoolnumber'];
        $products = $borrow['products'];
        
        $products_array = json_decode($products, true);
        
        var_dump($products_array);
        die();
    } else {
        echo "Geen resultaten gevonden.";
    }
}

?>

<div class="inlevering-container">
    <div class="header-container">
        <p>Inlevering van Thijn Glas</p>
        <p>studentennummer: 30639</p>
    </div>
    <footer class="content-container">
        <div class="products-container">
            <div class="names">
                <p></p>
                <p>product</p>
                <p>model</p>
                <p>aantal</p>
            </div>
            <div class="products">
                <img src="../img/resistor.png" alt="">
                <p>Resistor</p>
                <p>10.000 / 10k Ohm</p>
                <p class="aantalSpacer">3</p>
            </div>
        </div>
        <div class="footer-container">
            <div class="datum-container">
                <p>Welke dag moet dit ingeleverd worden?</p>
                <input type="date">
            </div>
            <div class="button-container">
                <button class="button"><img src="./img/check-solid.png" alt=""></button>
                <button class="button"><img src="./img/trash-can-solid2.png" alt=""></button>
            </div>
        </div>

    </footer>

    <footer>
        <link rel="stylesheet" href="./css/request.css">
    </footer>