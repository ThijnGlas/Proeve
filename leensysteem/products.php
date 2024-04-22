<div class="middleSection-container">
    <div class="productCard-container">
        <?php
        //in deze if statement check ik of er een post en of de post niet leeg is
        if (isset($_POST['zoekenInput']) && trim($_POST['zoekenInput']) != "") {
            //in deze query kijk ik of er artikels zijn waarvan de titel of het id in de database staat als beide niet waar zijn krijg je een message met daarin artikel niet gevonden.
            $productsFromDatabase = mysqli_query($connection, "SELECT * FROM products WHERE name LIKE '%" . $_POST['zoekenInput'] . "%' OR id = '" . $_POST['zoekenInput'] . "'") or die(mysqli_error($connection));
            if (mysqli_num_rows($productsFromDatabase) == 0) {
                header("location: home.php?page=products&action=product_notfound");
            }
        } else {
            //als er niks is ingetypt krijg je alle artikels te zien
            $productsFromDatabase = mysqli_query($connection, "SELECT * FROM products ORDER BY id DESC");
        }
        //met deze while krijg ik alle artikels uit de database in een tabel. Ook staan er twee buttons in per row deze button geven een page en een id mee, in de files addarticles en deletearticles zie je wat er mee gedaan word
        while ($row = mysqli_fetch_array($productsFromDatabase)) {
            echo "
            <a href=\"?page=product&id=".$row['id']."\">
                <div class=\"productCard\" 
                style=\"background-image: url(./img/".$row['img']."); background-repeat: no-repeat; background-size: cover;\">
                  <p>" . $row['name'] . "</p>
                  <p>" . $row['model_type'] . "</p>
                  <div class=\"productCardImage-container\">
                    <img src=\"./img/blackarrow.png\" alt=\"\">
                  </div>
                </div>
            </a>";
        }
        ?>

</div>

<footer>
    <link rel="stylesheet" href="./css/products.css">
</footer>