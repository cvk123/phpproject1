<?php

require "../classes/Student.php";
require "../classes/Database.php";
require "../classes/Auth.php";
require "../classes/Url.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Musíš se přihlásit!");
}

$connection = (new Database())->connectionDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (Student::deleteStudent($connection, $_GET["id"])) {
        URL::redirectUrl("/skola-project/admin/students.php");
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
                    <a class="zrusit" href="one-student.php?id=<?= $_GET['id'] ?>">Zrušit</a>
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