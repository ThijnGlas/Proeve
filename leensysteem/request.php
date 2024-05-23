<?php


?>

<div class="form-container">
    <div class="formulier">
        <h2>uw gegevens</h2>
        <form action="index.php" name="requestForm" method="post">
        <input name="requestForm" type="hidden" value="1">
        <div class="formLabel-container">
                <label for="name">naam:</label>
                <input type="text" id="name" name="nameInput">
            </div>
            <div class="formLabel-container">
                <label for="number">studentennummer:</label>
                <input type="number" id="number" name="numberInput">
            </div>
            <div class="button-container">
                <input type="submit" value="Stuur verzoek" class="button"></input>
            </div>
        </form>
    </div>
</div>

<footer>
    <link rel="stylesheet" href="./css/request.css">
</footer>