<?php 

require "../classes/Url.php";
require "../classes/Database.php";
require "../classes/User.php";
require "../assets/recaptcha.php";

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $connection = (new Database())->connectionDB();

    $first_name = $_POST["first-name"];
    $second_name = $_POST["second-name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    // Ověření reCAPTCHA
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $recaptchaSuccess = verifyRecaptcha($recaptchaResponse);
  
    
    // Vytvoření uživatele
    $id = User::createUser($connection, $first_name, $second_name, $email, $password, $recaptchaSuccess);
    
    if (!empty($id)) {
        session_regenerate_id(true);
    
        // Nastavení, že je uživatel přihlášen
        $_SESSION["is_logged_in"] = true;
        // Nastavení ID uživatele
        $_SESSION["logged_in_user"] = $id;
    
        URL::redirectUrl("/skola-project/admin/students.php");
    } else {
        URL::redirectUrl("/skola-project/registration-form.php?error=register-failed");
    }
    
}

?>