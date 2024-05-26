<?php

require_once ("functions.php");

$connection = dbconnect("c4993aps2");

?>

<nav>
    <h1>Aanvragen</h1>
    <form action="?page=requests" method="post">
        <input class="id-zoek" placeholder="zoek op naam/schoolnummer/id" name="zoekenInput" type="text">
        <input type="hidden" name="zoekenId" value="1">
    </form>
    <form action="?page=requests" method="get">
        <input type="hidden" name="accepted" value="1">
        <button type="submit">Toon Accepted Verzoeken</button>
    </form>
    <form action="?page=requests" method="get">
        <input type="hidden" name="both" value="1">
        <button type="submit">Toon Verzoeken zonder Status</button>
    </form>
    <form action="?page=requests" method="get">
        <input type="hidden" name="declined" value="1">
        <button type="submit">Toon Declined Verzoeken</button>
    </form>
</nav>

<div class="table-wrapper">
    <table class="table">
        <thead>
            <th><p>naam</p></th>
            <th></th>
            <th><p>schoolnummer</p></th>
            <th><p>datum aanvraag</p></th>
            <th></th>
        </thead>
        <tbody>
        <?php 
        if(isset($_POST['zoekenInput']) && trim($_POST['zoekenInput']) != ""){ 
            $searchInput = mysqli_real_escape_string($connection, $_POST['zoekenInput']);
            $requestsFromDatabase = mysqli_query($connection, "SELECT * FROM borrow WHERE name LIKE '%$searchInput%' OR id = '$searchInput' OR schoolnumber = '$searchInput'") or die (mysqli_error($connection)); 
            if (mysqli_num_rows($requestsFromDatabase) == 0) {
                header("location: home.php?page=requests&action=requests_notfound");
            }
        } 
        else if(isset($_GET['accepted'])) {
            $requestsFromDatabase = mysqli_query($connection, "SELECT * FROM borrow WHERE accepted = 1 ORDER BY id DESC");
        } 
        else if(isset($_GET['declined'])) {
            $requestsFromDatabase = mysqli_query($connection, "SELECT * FROM borrow WHERE declined = 1 ORDER BY id DESC");
        } 
        else {
            $requestsFromDatabase = mysqli_query($connection, "SELECT * FROM borrow WHERE accepted != 1 AND declined != 1 ORDER BY id DESC");
        }

        while ($row = mysqli_fetch_array($requestsFromDatabase)) {
                echo "
                <tr>
                <td class=\"title\" colspan=\"2\"><p>" . $row['name'] . "</p></td>
                <td ><p>" . $row['schoolnumber'] . "</p></td>
                <td ><p>Aangevraagd op " . $row['date_requested'] . "</p></td>
                <td class=button-w><a href=\"?page=request&id=".$row['id']."\"><img src=\"./img/arrow-r.png\" alt=\"\"></a>
                </td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<footer>
    <link rel="stylesheet" href="./css/tablePage.css">
</footer>
