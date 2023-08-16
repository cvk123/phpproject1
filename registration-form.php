<?php
$queryString = $_SERVER['QUERY_STRING'];
parse_str($queryString, $parameters);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./query/header-querymain.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/registration-form.css">
    <link rel="cv icon" href="./img/logo.jpg" type="img">
    <script src="https://kit.fontawesome.com/2e503376a7.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <title>registration</title>
</head>

<body>
    <div id="bg"></div>



    <?php require "assets/header.php"; ?>

    <main>
        <section class="add-form">
            <div class="container">
                <h1>Zaregistrovat se</h1>

                <?php
                if (isset($parameters["error"])) {
                    switch ($parameters["error"]) {
                        case "register-failed":
                            print("<span class='error'>Musíš správně potvrdit Captchu!</span>");
                            break;
                    }
                }
                ?>

                <form action="admin/after-registration.php" method="POST" class="harry-potter-form">
                    <div class="form-group">
                        <input type="text" name="first-name" placeholder="Křestní jméno" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="second-name" placeholder="Příjmení" required>
                    </div>
                    <div class="form-group">
                        <div id="error-message"></div>
                        <input type="email" name="email" id="email" placeholder="Email@" required>
                    </div>
                    <!-- HESLA verifaction  -->
                    <div class="form-group">
                        <div class="password-container">
                            <input type="password" name="password" id="login-password" placeholder="Zadejte heslo" required>
                            <i class="fa-solid fa-eye" id="show-password"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="password-container">
                            <input type="password" name="password1" placeholder="Zadejte heslo znovu" id="login-password1" required>
                            <i class="fa-solid fa-eye" id="show-password1"></i>
                        </div>
                    </div>
                    <p class="result-text"></p>


                    <div class="row">
                        <div class="g-recaptcha" data-sitekey="6Lc-aTInAAAAAELxiD5TMq7KNjOVk_MT3GMaxM53">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit">Zaregistrovat se</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <?php require "assets/footer.php"; ?>

    <script src="js/header.js"></script>
    <script src="js/particles.min.js"></script>
    <script src="js/stars.js"></script>
    <script src="js/hidepw.js"></script>
    <script src="js/passwordchecer.js"></script>


</body>

</html>