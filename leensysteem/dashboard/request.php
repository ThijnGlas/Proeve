<?php
$id = $_GET['id'];

$message = "";

if ($_GET['message']) {
    echo "<p>u heeft geen datum ingevoerd</p>";
}

if ($id) {
    $get_borrow = mysqli_query($connection, "SELECT * FROM borrow WHERE id = '" . mysqli_real_escape_string($connection, $id) . "' LIMIT 1") or die(mysqli_error($connection));

    if ($borrow = mysqli_fetch_assoc($get_borrow)) {
        $name = $borrow['name'];
        $schoolnummer = $borrow['schoolnumber'];
        $products = $borrow['products'];
        $accepted = $borrow['accepted'];
        $declined = $borrow['declined'];

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


if (isset($_POST['declined'])) {
    $reason = $_POST['reason'];

    $currentDate = date('Y-m-d');


    verstuur_mail($name, $schoolnummer, $currentDate, $reason, false);
}


?>
<a href="?page=requests">
    <p class="terug"><- terug</p>
</a>
<div class="inlevering-container">
    <?= $message ?>


    <div class="header-container">
        <p>aanvraag van <?php echo $name; ?></p>
        <p>studentennummer: <?= $schoolnummer; ?></p>
    </div>
    <footer class="content-container">
        <div class="products-container">
            <div class="names">
                <p></p>
                <p>product</p>
                <p>model</p>
                <p>locatie</p>
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
                        <p><?php echo $product['storage']; ?></p>
                        <p class="aantalSpacer"><?php echo $product['quantity']; ?></p>
                    </div>
                <?php endforeach;
            else: ?>
                <p>Geen producten gevonden.</p>
            <?php endif; ?>
        </div>
        <div class="footer-container">

            <div class="datum-container">
                <p>Welke dag moet dit ingeleverd worden?</p>
                <form action="home.php" name="requestupdateForm" method="post">
                    <input type="hidden" name="requestupdateForm">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input type="date" name="date">
            </div>
            <div class="button-container">
                <div class="reden">
                    <label class="label-reden" for="reason">Reden voor afwijzing:</label><br>
                    <textarea class="text-reden" id="reason" name="reason" required></textarea><br>
                </div>
                <button type="submit" name="accepted" value="1" class="button">Accept</button>
                <?php if ($declined != 1): ?>
                    <button type="submit" name="declined" value="1" class="button">Decline</button>
                <?php endif; ?>
                </form>
            </div>
        </div>
    </footer>
    <footer>
        <link rel="stylesheet" href="./css/request.css">
    </footer>
</div>