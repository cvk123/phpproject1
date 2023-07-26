<?php

/**
 * 
 * Přidaní uživatele do databáze
 * 
 * @param object $connection - napojení na databázi
 * @param string $first_name - křestní jméno žáka
 * @param string $second_name - druhé jméno žáka
 * @param string $email - emailová adresa uživatele
 * @param string $password - heslo uživatele
 * @param bool $recaptchaSuccess - úspěšné ověření reCAPTCHA
 * 
 * @return int|null - id nově vytvořeného záznamu nebo null v případě chyby
 * 
 */
function createUser($connection, $first_name, $second_name, $email, $password, $recaptchaSuccess) {

    // Kontrola, zda emailová adresa již existuje v databázi
    $existingEmailQuery = "SELECT id FROM user WHERE email = ?";
    $existingEmailStatement = mysqli_prepare($connection, $existingEmailQuery);
    mysqli_stmt_bind_param($existingEmailStatement, "s", $email);
    mysqli_stmt_execute($existingEmailStatement);
    mysqli_stmt_store_result($existingEmailStatement);

    if (mysqli_stmt_num_rows($existingEmailStatement) > 0) {
        return null;
    }

    // Pokračovat pouze pokud reCAPTCHA byla úspěšně ověřena
    if (!$recaptchaSuccess) {
        return null;
    }

    // Pokračovat s vytvořením nového záznamu v databázi
    $insertQuery = "INSERT INTO user (first_name, second_name, email, password) VALUES (?, ?, ?, ?)";
    $insertStatement = mysqli_prepare($connection, $insertQuery);
    mysqli_stmt_bind_param($insertStatement, "ssss", $first_name, $second_name, $email, $password);
    mysqli_stmt_execute($insertStatement);

    // Získání id nově vytvořeného záznamu
    $id = mysqli_stmt_insert_id($insertStatement);

    return $id;
}

/**
 * 
 * Ověření uživatele pomocí emailu a hesla
 * 
 * @param object $connection - napojení na databázi
 * @param string $log_email - emailová adresa uživatele
 * @param string $log_password - heslo uživatele
 * 
 * @return boolean - true pokud je uživatel úspěšně ověřen, jinak false
 * 
 */

function authentication($connection, $log_email, $log_password){
    $sql = "SELECT password FROM user WHERE email = ?";
    $stmt = mysqli_prepare($connection, $sql);  
    
    if($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $log_email);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            if($result->num_rows != 0) {
                 $password_database = mysqli_fetch_row($result);
                 $user_password_database = $password_database[0];
            
                if($user_password_database) {
                    return password_verify($log_password, $user_password_database);
                }

            
           
            } else {
               return false; 
            }
        } else {
            return false; 
        }
    } else {
        echo "Error: " . mysqli_error($connection);
        return false; 
    }
}

/**
 * 
 * Získání id uživatele 
 * 
 * @param object $connection - napojení na databázi
 * @param string $email - emailová adresa uživatele
 * 
 * @return int|null - id uživatele nebo null v případě chyby
 * 
 */


 function getUserId($connection, $email) {
    $sql = "SELECT id FROM user WHERE email = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);

        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $id = mysqli_fetch_row($result);
            $id_user = $id[0];
            
            return $id_user[0];
        } else {
            return null;
        }
    } else {
        echo "Error: " . mysqli_error($connection);
        return null;
    }
 }