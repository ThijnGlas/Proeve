<?php
$id = $_GET['id'];
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

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $row['quantity'] = $product_quantity;
                    $products_details[] = $row;
                }
            } else {
                echo "Geen producten gevonden voor product ID: $product_id<br>";
            }
        }
    } else {
        echo "Geen resultaten gevonden.";
    }
} else {
    echo "Geen ID opgegeven.";
}

?>
<a href="?page=turnins">
    <p class="terug"><- terug</p>
</a>
<div class="inlevering-container">

    <div class="header-container">
        <p>Inlevering van <?= $name ?></p>
        <p>studentennummer: <?= $schoolnummer ?></p>
    </div>
    <footer class="content-container">
        <div class="products-container">
            <div class="names">
                <p></p>
                <p>product</p>
                <p>model</p>
                <p>aantal</p>
            </div>
            <?php if (!empty($products_details)):
                foreach ($products_details as $product): ?>
                    <div class="products">
                        <div>
                            <img class="img" src="../img/<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                        </div>
                        <p><?php echo $product['name']; ?></p>
                        <p><?php echo $product['model_type']; ?></p>
                        <p class="aantalSpacer"><?php echo $product['quantity']; ?></p>
                    </div>
                <?php endforeach;
            else: ?>
                <p>Geen producten gevonden.</p>
            <?php endif; ?>
        </div>
        <div class="footer-container-turnin">
            <form action="home.php" name="turninForm" method="post">
                <input type="hidden" name="turninForm">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="button-container-turnin">
                    <button type="submit" name="accepted" value="1" class="button">accepteer</button>
                    <a href="?page=turninmissing&id=<?= $id; ?>" class="button">er mist iets</a>
            </form>
        </div>
</div>

</footer>

<footer>
    <link rel="stylesheet" href="./css/request.css">
</footer>