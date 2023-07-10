<?php

    require "url.php";

/**
 *
 * Získá jednoho žáka z databáze podle ID
 *
 * @param object $connection - napojení na databázi
 * @param integer $id - id jednoho konkrétního žáka
 *
 * @return mixed asociativní pole, které obsahuje informace o jednom konkrétním žákovi nebo vrátí null, pokud žák nebyl nalezen
 *
 */

function getStudent($connection, $id, $columns = "*") {
    $sql = "SELECT $columns
            FROM student
            WHERE id = ?";
   
    $stmt = mysqli_prepare($connection, $sql);


    if ($stmt === false) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);


        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}

/**
 *
 * Updatuje informace o žákovi v databázi
 *
 * @param object  $connection - napojení na databázi
 * @param string  $first_name - Křestní jméno žáka
 * @param string  $second_name - Druhé jméno žáka
 * @param integer $age - Věk žáka
 * @param string  $life - Informace o žákovi
 * @param string  $college - Kolej žáka
 * @param integer $id - ID žáka
 *
 * @return void 
 *
 */

function udpateStudent($connection, $first_name, $second_name, $age, $life, $college, $id){

    $sql = "UPDATE student
            SET first_name = ?,
                second_name = ?,
                age = ?,
                life = ?,
                college = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

        if (!$stmt) {
            echo mysqli_error($connection);
        } else {
            mysqli_stmt_bind_param($stmt, "ssissi", $first_name, $second_name, $age, $life, $college, $id);

       if (mysqli_stmt_execute($stmt)) {

          redirectUrl("/databaze/admin/jeden-zak.php?id=$id");
            
       }
    }
}

/**
 * 
 * Vymaže studenta z databáze podle ID
 * 
 * @param object $connection - napojení na databázi
 * @param integer $id - id daného žáka
 * 
 * @return void
 */

function deleteStudent($connection, $id){
    $sql = "DELETE 
            FROM student 
            WHERE id = ?";
    
    $stmt = mysqli_prepare($connection, $sql);

    if (!$stmt) {
        echo mysqli_error($connection);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)){
            redirectUrl("/databaze/admin/zaci.php");
        }
    }
}

/**
 * 
 * Vrátí všechny žáky z databáze
 * 
 * @param object $connection - napojení na databázi
 * 
 * @return array pole objektů, kde každý objekt je jeden žák
 * 
 */


function getALLStudents($connection, $columns = "*"){
    $sql = "SELECT $columns 
            FROM student";
    
    $result = mysqli_query($connection, $sql);
    
    
    if ($result === false) {
        echo mysqli_error($connection);
        return [];
    } else {
        $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $students;    
    }
}

/**
 * 
 * Přidá žáka do databáze a přesměruje nás na profil žáka
 * 
 * @param object $connection - napojení na databázi
 * @param string $first name - křestní jméno žáka
 * @param string $second name - druhé jméno žáka
 * @param integer $age - věk žáka
 * @param string $life - Informace o žákovi
 * @param string $college - Kolej žáka
 * 
 * @return void
 * 
 */

function createStudent($connection, $first_name, $second_name, $age, $life, $college){
    $sql = "INSERT INTO student (first_name, second_name, age, life, college )
    VALUES (?, ?, ?, ?, ?)";

    
   
   $statement = mysqli_prepare($connection, $sql);
   if ($statement === false) {
    echo mysqli_error($connection);
    } else {
    mysqli_stmt_bind_param($statement, "ssiss", $first_name, $second_name, $age, $life, $college);


    if(mysqli_stmt_execute($statement)) {
        $id = mysqli_insert_id($connection);

        redirectUrl("/databaze/admin/jeden-zak.php?id=$id");

    } else {
        echo mysqli_stmt_error($statement);
    }
}
}