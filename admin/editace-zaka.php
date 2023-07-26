<?php


    require "../assets/database.php";
    require "../assets/zak.php";
    require "../assets/auth.php";

    session_start();
    
    if(!isLoggedIn()){
        die("Musíš se přihlásit!");
    }


    $connection = connectionDB();
   

    if ( isset($_GET["id"]) ){
        $one_student = getStudent($connection, $_GET["id"]);

        if ( $one_student ){
            $first_name = $one_student["first_name"];
            $second_name = $one_student["second_name"];
            $age = $one_student["age"];
            $life = $one_student["life"];
            $college = $one_student["college"];
            $id = $one_student["id"];
        } else {
            die("Student nenalezen");
        }


    } else {
        die("Student nenalezen");
    }


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $first_name = $_POST["first_name"];
        $second_name = $_POST["second_name"];
        $age = $_POST["age"];
        $life = $_POST["life"];
        $college = $_POST["college"];

        udpateStudent($connection, $first_name, $second_name, $age, $life, $college, $id);
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
    <link rel="stylesheet" href="../css/formular.css">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <link rel="cv icon" href="../img/logo.jpg" type="img">
    <title>Editovat žáka</title>
</head>

<body>
    <div id="bg"></div>



    <?php require "../assets/admin-header.php"; ?>

    <main>

        <section class="add-form">

            <div class="container">
                <h1>Editovat žáka</h1>
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