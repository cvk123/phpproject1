<?php

    require "../classes/Database.php";
    require "../classes/Student.php";
    require "../classes/Auth.php";

    session_start();
    
    if(!Auth::isLoggedIn()){
        die("Musíš se přihlásit!");
    }


    $connection = (new Database())->connectionDB();
    
    $students = Student::getALLStudents($connection, "id, first_name, second_name");

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
    <link rel="stylesheet" href="../css/students.css">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <link rel="cv icon" href="../img/logo.jpg" type="img">
    <title>Document</title>
</head>

<body>

    <div id="bg"></div>

    <?php require "../assets/admin-header.php"; ?>

    <section class="main-heading">
        <h1>Seznam žáků školy</h1>
    </section>

    <section class="filter">
        <input type="text" class="filter-input" placeholder="Jméno žáka">
    </section>

    <main>


        <?php if(empty($students)): ?>
        <p>Žádní žáci nebyli nalezeni</p>
        <?php else: ?>
        <div class="table">
            <?php foreach($students as $one_student): ?>
            <div class="table-row">
                <div class="table-cell">
                    <?php echo htmlspecialchars($one_student["first_name"]). " " .htmlspecialchars($one_student["second_name"]) ?>
                </div>
                <div class="table-cell">
                    <a href="one-student.php?id=<?= $one_student["id"] ?>" class="more-info">Více informací</a>
                </div>
            </div>
            <?php endforeach ?>
        </div>
        <?php endif ?>

    </main>

    <?php require "../assets/footer.php"; ?>

    <script src="../js/header.js"></script>
    <script src="../js/particles.min.js"></script>
    <script src="../js/stars.js"></script>
    <script src="../js/filter.js"></script>
</body>

</html>