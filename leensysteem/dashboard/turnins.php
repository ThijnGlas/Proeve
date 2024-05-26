<nav>
    <h1>Inleveringen</h1>
    <a href="?page=turnins&late=1"><button type="submit">Toon Te Late Inleveringen</button></a>
    <a href="?page=turnins&all=1"><button type="submit">Toon Alle Inleveringen</button></a>
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
            if (isset($_GET['late'])) {
                $lateReturns = mysqli_query($connection, "SELECT * FROM borrow WHERE date_tobereturned < CURDATE() ORDER BY date_tobereturned DESC") or die(mysqli_error($connection));
                while ($row = mysqli_fetch_array($lateReturns)) {
                    echo "
                <tr>
                <td><p>" . $row['name'] . "</p></td>
                <td><p>" . $row['date_tobereturned'] . "</p></td>
                <td class=button-w><a href=\"?page=turnin&id=".$row['id']."\"><img src=\"./img/arrow-r.png\" alt=\"\"></a>
                </tr>";
                }
            } else {
                $allReturns = mysqli_query($connection, "SELECT * FROM borrow ORDER BY date_tobereturned DESC") or die(mysqli_error($connection));
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