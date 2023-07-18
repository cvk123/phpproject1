<?php 

require "../assets/url.php";
require "../assets/database.php";
require "../assets/user.php";
require "../assets/recaptcha.php";

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $connection = connectionDB();
    
    $first_name = $_POST["first-name"];
    $second_name = $_POST["second-name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    // Ověření reCAPTCHA
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $recaptchaSuccess = verifyRecaptcha($recaptchaResponse);
  
    
    // Vytvoření uživatele
    $id = createUser($connection, $first_name, $second_name, $email, $password, $recaptchaSuccess);
    
    if (!empty($id)) {
        session_regenerate_id(true);
    
        // Nastavení, že je uživatel přihlášen
        $_SESSION["is_logged_in"] = true;
        // Nastavení ID uživatele
        $_SESSION["logged_in_user"] = $id;
    
        redirectUrl("/skola-project/admin/zaci.php");
    } else {
        echo "Uživatele se nepodařilo vytvořit";
    }
    
}

?>