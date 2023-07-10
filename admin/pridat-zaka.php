<?php

require "../assets/database.php";
require "../assets/zak.php";

$first_name = null;
$second_name = null;
$age = null;
$life = null;
$college = null;


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first_name = $_POST["first_name"];
    $second_name = $_POST["second_name"];
    $age = $_POST["age"];
    $life = $_POST["life"];
    $college = $_POST["college"];

    $connection = connectionDB();  
    
    createStudent($connection, $first_name, $second_name, $age, $life, $college);
}


?>


<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="formular.css">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <title>Přidat žáka</title>
</head>
<body>
    <div id="bg"></div>

    

    <?php require "../assets/admin-header.php"; ?>

    <main>
    
        <section class="add-form">
            
            <div class="container">
            <h1>Přidej žáka</h1>
                <?php require "../assets/formular-zak.php"; ?>
            </div>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>

    <script src="../js/header.js"></script>
    <script src="../js/particles.min.js"></script>
    <script src="../js/stars.js"></script>
</body>
</html>
