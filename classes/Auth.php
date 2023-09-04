<?php 

class Auth {
/**
 * Ověřuje zda je uživatel přihlášený
 * @return boolean True pokud je uživatel přihlášený
 */

    public static function isLoggedIn(){
        return isset($_SESSION['is_logged_in']) && $_SESSION["is_logged_in"];
    }
}