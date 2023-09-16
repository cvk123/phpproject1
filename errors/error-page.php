<?php

    $error_text = $_GET["error_text"];
    echo $error_text;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <title>Error</title>
</head>

<body>
    <div id="bg"></div>


    <main>
        <h1>Error</h1>
        <section class="error">
            <p><?= $error_text ?></p>
        </section>



        <script src=" ../js/header.js"></script>
        <script src="../js/particles.min.js"></script>
        <script src="../js/stars.js"></script>
</body>

</html>