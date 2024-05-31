<?php

$id = $_GET['id'];
$connection = dbconnect("c5831Leensysteem");

if ($id) {
    $get_borrow = mysqli_query($connection, "SELECT * FROM borrow WHERE id = '" . mysqli_real_escape_string($connection, $id) . "' LIMIT 1") or die(mysqli_error($connection));

    if ($borrow = mysqli_fetch_assoc($get_borrow)) {
        $name = $borrow['name'];
        $schoolnummer = $borrow['schoolnumber'];
        $products = $borrow['products'];

        $products_array = json_decode($products, true);

        $products_details = [];
        foreach ($products_array as $product) {
            $product_id = $product['item_id'];
            $product_quantity = $product['item_quantity'];
            $sql = "SELECT * FROM products WHERE id = $product_id";
            $result = $connection->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row['quantity'] = $product_quantity;
                    $products_details[] = $row;
                }
            }
        }
    } else {
        echo "Geen resultaten gevonden.";
    }
} else {
    echo "Geen ID opgegeven.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_quantities'])) {
    $updated_quantities = $_POST['product_quantities'];
    $updated_products_array = [];

    foreach ($products_array as $key => &$product) {
        $product_id = $product['item_id'];
        $original_quantity = $product['item_quantity'];
        $returned_quantity = isset($updated_quantities[$product_id]) ? (int)$updated_quantities[$product_id] : 0;

        if ($returned_quantity > 0) {
            $product['item_quantity'] = $returned_quantity;
            $updated_products_array[] = $product;
            // Update de voorraad in de database
            mysqli_query($connection, "UPDATE products SET amount = amount + $returned_quantity WHERE id = '$product_id'");
        }

        // Indien niet alle items zijn teruggebracht, update de voorraad met het verschil
        if ($returned_quantity < $original_quantity) {
            $missing_quantity = $original_quantity - $returned_quantity;
            mysqli_query($connection, "UPDATE products SET amount = amount - $missing_quantity WHERE id = '$product_id'");
        }
    }

    $updated_products_json = json_encode($updated_products_array);

    $update_query = "UPDATE borrow SET 
        products = '" . mysqli_real_escape_string($connection, $updated_products_json) . "', 
        date_returned = '" . gmdate('Y-m-d') . "' 
        WHERE id = '" . mysqli_real_escape_string($connection, $id) . "'";
    mysqli_query($connection, $update_query) or die(mysqli_error($connection));
    header("Location: home.php?page=turnins");
    exit();
}
?>

<a href="?page=turnin&id=<?= $id ?>">
    <p class="terug"><- terug</p>
</a>
<div class="inlevering-container">

    <div class="header-container">
        <p>welke spullen zijn er nog van de geleende spullen?</p>
        <p>inlevering van: <?= $name ?></p>
    </div>
    <footer class="content-container">
        <form class="width" action="home.php?page=turninmissing&id=<?= $id ?>" method="post">
            <div class="products-container">
                <div class="names missing">
                    <p></p>
                    <p>product</p>
                    <p>model</p>
                    <p>locatie</p>
                    <p>aantal</p>
                </div>
                <?php if (!empty($products_details)): ?>
                    <?php foreach ($products_details as $product): ?>
                        <div class="products missing">
                            <div>
                                <img class="img" src="../img/<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                            </div>
                            <p><?php echo $product['name']; ?></p>
                            <p><?php echo $product['model_type']; ?></p>
                            <p><?php echo $product['storage']; ?></p>

                            <input type="number" name="product_quantities[<?php echo $product['id']; ?>]" placeholder="0" class="aantalSpacer" value="<?php echo $product['quantity']; ?>">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Geen producten gevonden.</p>
                <?php endif; ?>
            </div>
            <div class="footer-container-turnin">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="button-container-turnin">
                    <input type="submit" class="button" value="verstuur">
                    <a href="?page=turnin&id=<?= $id ?>" class="button">terug</a>
                </div>
            </div>
        </form>
    </footer>

    <footer>
        <link rel="stylesheet" href="./css/request.css">
    </footer>
</div>
