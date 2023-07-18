<?php

/**
 * 
 * Ověřuje zda je uživatel přihlášený
 * 
 * @return boolean True pokud je uživatel přihlášený
 * 
 */

function isLoggedIn(){
    return isset($_SESSION['is_logged_in']) && $_SESSION["is_logged_in"];
}