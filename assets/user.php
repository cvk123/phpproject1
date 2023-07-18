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