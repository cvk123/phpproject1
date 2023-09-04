<?php

class Database {

/**
 * Připojení se k databázi
 *
 * @return object - pro připojení do databáze
 */

public function connectionDB()
{
    $db_host = "127.0.0.1";
    $db_user = "Pavel1";
    $db_password = "admin123";
    $db_name = "skola";


    $connection = "mysql:host=" .$db_host. ";dbname=" .$db_name . ";charset=utf8";


    try {
        $db = new PDO($connection, $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
        
  }
}