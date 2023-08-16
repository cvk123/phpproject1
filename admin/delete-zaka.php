<?php

require "../assets/zak.php";
require "../assets/database.php";
require "../assets/auth.php";
require "../assets/url.php";

session_start();

if (!isLoggedIn()) {
    die("Musíš se přihlásit!");
}

$connection = connectionDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (deleteStudent($connection, $_GET["id"])) {
        redirectUrl("/skola-project/admin/zaci.php");
    };
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/delete-zaka.css">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <link rel="cv icon" href="../img/logo.jpg" type="img">
    <title>Smazat žáka</title>
</head>

<body>

    <div id="bg"></div>

    <?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="delete-form">
            <form method="POST">
                <p>Jste si jisti, že chcete tohoto žáka smazat?</p>
                <div class="buttons">
                    <button class="smazat">Smazat</button>
                    <a class="zrusit" href="jeden-zak.php?id=<?= $_GET['id'] ?>">Zrušit</a>
                </div>
            </form>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>

    <script src="../js/header"></script>
    <script src="../js/particles.min.js"></script>
    <script src="../js/stars.js"></script>
</body>

</html>