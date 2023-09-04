<?php

require "../classes/Database.php";
require "../classes/Student.php";
require "../classes/Auth.php";

session_start();

// Check if user is logged in
if (!Auth::isLoggedIn()) {
    die("Nepovolený přístup");
}

// Connect to database
$connection = (new Database())->connectionDB();

// Get student by id
if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
    $students = Student::getStudent($connection, $_GET["id"]);
} else {
    $students = null;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/jeden-zak.css">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>

    <body>

        <div id="bg"></div>

        <?php require "../assets/admin-header.php"; ?>



        <main>
            <section class="main-heading">
                <h1>Informace o žákovi</h1>
            </section>
            <?php if ($students === null) : ?>
            <p>Žák nenalezen</p>
            <?php else : ?>
            <div class="student-info">
                <h2><?= htmlspecialchars($students["first_name"]) . " " . htmlspecialchars($students["second_name"]) ?>
                </h2>
                <p class="info-label">Věk:</p>
                <p class="info-value"><?= htmlspecialchars($students["age"]) ?></p>
                <p class="info-label">Dodatečné informace:</p>
                <p class="info-value"><?= $students["life"] ?></p>
                <p class="info-label">Kolej:</p>
                <p class="info-value"><?= htmlspecialchars($students["college"]) ?></p>
            </div>
            <?php endif ?>
            <section class="buttons">
                <a href="editace-zaka.php?id=<?= $students['id'] ?>">Editovat</a>
                <a class="smazat" href="delete-zaka.php?id=<?= $students['id'] ?>">Vymazat</a>
            </section>
        </main>

        <?php require "../assets/footer.php"; ?>

        <script src="../js/header.js"></script>
        <script src="../js/particles.min.js"></script>
        <script src="../js/stars.js"></script>
    </body>

</html>