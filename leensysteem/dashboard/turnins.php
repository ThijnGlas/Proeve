<nav>
    <h1>Inleveringen</h1>
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
                $turninsFromDatabase = mysqli_query($connection, $query) or die(mysqli_error($connection));
            
                if (mysqli_num_rows($turninsFromDatabase) == 0) {
                    header("Location: home.php?page=turnins&action=requests_notfound");
                } else {
                    while ($row = mysqli_fetch_array($turninsFromDatabase)) {
                        echo "
                        <tr>
                            <td><p>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</p></td>
                            <td><p>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</p></td>
                            <td><p>" . htmlspecialchars($row['schoolnumber'], ENT_QUOTES, 'UTF-8') . "</p></td>
                            <td class=button-w><a href=\"?page=turnin&id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "\"><img src=\"./img/arrow-r.png\" alt=\"\"></a></td>
                        </tr>";
                    }
                }
            }
            
            elseif (isset($_GET['late'])) {
                $lateReturns = mysqli_query($connection, "SELECT * FROM borrow WHERE date_tobereturned < CURDATE() AND (date_returned IS NULL OR date_returned = '0000-00-00') ORDER BY date_tobereturned DESC") or die(mysqli_error($connection));
                while ($row = mysqli_fetch_array($lateReturns)) {
                    echo "
                <tr>
                <td><p>" . $row['name'] . "</p></td>
                <td><p>" . $row['date_tobereturned'] . "</p></td>
                <td class=button-w><a href=\"?page=turnin&id=".$row['id']."\"><img src=\"./img/arrow-r.png\" alt=\"\"></a></td>
                </tr>";
                }
            }
            
            elseif (isset($_GET['turnedin'])) {
                $allReturns = mysqli_query($connection, "SELECT * FROM borrow WHERE date_returned IS NOT NULL AND date_returned != '0000-00-00' ORDER BY date_tobereturned DESC") or die(mysqli_error($connection));
                while ($row = mysqli_fetch_array($allReturns)) {
                    echo "
                <tr>
                <td><p>" . $row['name'] . "</p></td>
                <td><p>" . $row['date_returned'] . "</p></td>
                <td class=button-w><a href=\"?page=turnin&id=" . $row['id'] . "\"><img src=\"./img/arrow-r.png\" alt=\"\"></a></td>
                </tr>";
                }
            }
            else {
                $allReturns = mysqli_query($connection, "SELECT * FROM borrow WHERE date_returned IS NULL OR date_returned = '0000-00-00' ORDER BY date_tobereturned DESC") or die(mysqli_error($connection));
                while ($row = mysqli_fetch_array($allReturns)) {
                    echo "
                <tr>
                <td><p>" . $row['name'] . "</p></td>
                <td><p>" . $row['date_tobereturned'] . "</p></td>
                <td class=button-w><a href=\"?page=turnin&id=".$row['id']."\"><img src=\"./img/arrow-r.png\" alt=\"\"></a>
                </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<footer>
    <link rel="stylesheet" href="./css/tablePage.css">
</footer>