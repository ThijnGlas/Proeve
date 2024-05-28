<nav>
    <h1>Inleveringen</h1>
    <form action="?page=turnins" method="post">
        <input class="id-zoek" placeholder="zoek op naam/schoolnummer/id" name="zoekenInput" type="text">
        <input type="hidden" name="zoekenId" value="1">
    </form>
    <a href="?page=turnins&late=1"><button type="submit">Toon Te Late Inleveringen</button></a>
    <a href="?page=turnins&all=1"><button type="submit">Toon Alle Inleveringen</button></a>
    <a href="?page=turnins&turnedin=1"><button type="submit">Toon ingeleverde Inleveringen</button></a>

</nav>

<div class="table-wrapper">
    <table class="table">
        <thead>
            <th>
                <p>naam</p>
            </th>
            <th>
                <p>datum geplande Inlevering</p>
            </th>
            <th></th>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['zoekenInput']) && trim($_POST['zoekenInput']) != "") {
                $searchInput = mysqli_real_escape_string($connection, $_POST['zoekenInput']);
                $query = "SELECT * FROM borrow WHERE name LIKE '%$searchInput%' OR id LIKE '%$searchInput%' OR schoolnumber LIKE '%$searchInput%'";
                $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

                if (mysqli_num_rows($results) == 0) {
                    header("Location: home.php?page=turnins&action=requests_notfound");
                }
            } else {
                if (isset($_GET['late'])) {
                    $query = "SELECT * FROM borrow WHERE date_tobereturned < CURDATE() AND (date_returned IS NULL OR date_returned = '0000-00-00') ORDER BY date_tobereturned DESC";
                } elseif (isset($_GET['turnedin'])) {
                    $query = "SELECT * FROM borrow WHERE date_returned IS NOT NULL AND date_returned != '0000-00-00' ORDER BY date_tobereturned DESC";
                } else {
                    $query = "SELECT * FROM borrow WHERE date_returned IS NULL OR date_returned = '0000-00-00' ORDER BY date_tobereturned DESC";
                }
                $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
            }

            while ($row = mysqli_fetch_array($results)) {
                echo "
            <tr>
                <td><a href=\"?page=turnin&id=" . $row['id'] . "\"><p>" . $row['name'] . "</p></a></td>
                <td><a href=\"?page=turnin&id=" . $row['id'] . "\"><p>" . $row['date_tobereturned'] . "</p></a></td>
                <td class=button-w><a href=\"?page=turnin&id=" . $row['id'] . "\"><img src=\"./img/arrow-r.png\" alt=\"\"></a></td>
        </tr>";
            }
            ?>

        </tbody>
    </table>
</div>

<footer>
    <link rel="stylesheet" href="./css/tablePage.css">
</footer>