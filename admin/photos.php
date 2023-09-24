<?php

    require "../classes/Auth.php";
    require "../classes/Image.php";
    require "../classes/Database.php";
    require "../classes/Student.php";

    session_start();

    $role = $_SESSION["role"];

    // If user is not logged in, redirect to login page
    if (!Auth::isLoggedIn()) {
        die(header("Location:../signin.php"));    
    }

    $connection = (new Database())->connectionDB();

    $user_id = $_SESSION["logged_in_user"];
    $allImages = Image::getImageByUserId($connection, $user_id);
    

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
    <link rel="stylesheet" href="../css/uploadphotos.css">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <link rel="cv icon" href="../img/logo.jpg" type="img">
    <title>Photos</title>
</head>

<body>
    <div id="bg"></div>

    <?php require "../assets/admin-header.php"; ?>

    <?php
    if ($role === "admin") : ?>
    <main>
        <h1>Pictures</h1>
        <section class="upload-photos">

            <form action="uploadphotos.php" method="POST" enctype="multipart/form-data">
                <label for="image" class="upload-button">
                    <i class="fas fa-upload upload-icon"></i>
                </label>

                <input type="file" name="image" id="image" accept="image/*" required>

                <input type="submit" name="submit" value="Odeslat obrázek" class="upload-button">
            </form>
        </section>

        <section class="images">
            <article>
                <?php foreach($allImages as $image): ?>
                <div>
                    <div>
                        <img src="../uploads/<?= $user_id ?>/<?= $image["image_name"] ?>" alt="image">
                    </div>

                    <div>
                        <a href="../uploads/<?= $user_id ?>/<?= $image["image_name"] ?>" download>Stáhnout</a>
                        <a href="deletephoto.php?id=<?= $user_id ?>&image_name=<?=$image["image_name"] ?> ">Smazat</a>
                    </div>
                </div>

                <?php endforeach; ?>
            </article>
        </section>
    </main>

    <?php endif; ?>


    <?php require "../assets/footer.php"; ?>

    <script src=" ../js/header.js"></script>
    <script src="../js/particles.min.js"></script>
    <script src="../js/stars.js"></script>
</body>

</html>