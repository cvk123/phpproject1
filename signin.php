<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./query/header-querymain.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/signin.css">
    <link rel="cv icon" href="./img/logo.jpg" type="img">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <title>Sign in</title>
</head>

<body>
    <div id="bg"></div>

    <?php require "assets/header.php"; ?>

    <main>

        <section class="add-form">
            <div class="container">
                <h1>Přihlášení</h1>
                <form action="admin/login.php" method="POST">
                    <div class="form-group">
                        <label for="login-email">Email:</label>
                        <input type="email" name="login-email" id="login-email" placeholder="Email">
                    </div>
                    <div class=" form-group">
                        <label for="login-password">Heslo:</label>
                        <div class="password-container">
                            <input type="password" name="login-password" id="login-password" placeholder="Heslo">
                            <i class="fa-solid fa-eye" id="show-password"></i>
                        </div>
                    </div>
                    <input type="submit" value="Přihlásit">
                </form>
            </div>
        </section>

        <p class="text">Zapomněl si heslo? Klikni <a class=" click" href=" resetpassword.php">zde</a></p>


    </main>

    <?php require "assets/footer.php"; ?>

    <script src="js/header.js"></script>
    <script src="js/hidepw.js"></script>
    <script src="js/particles.min.js"></script>
    <script src="js/stars.js"></script>

</body>

</html>