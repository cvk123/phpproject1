<?php

class Student {
/**
 * Získá jednoho žáka z databáze podle ID
 * @param object $connection - napojení na databázi
 * @param integer $id - id jednoho konkrétního žáka
 * @return mixed asociativní pole, které obsahuje informace o jednom konkrétním žákovi nebo vrátí null, pokud žák nebyl nalezen
 */

    public static function getStudent($connection, $id, $columns = "*")
    {
        $sql = "SELECT $columns
                FROM student
                WHERE id = :id";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            
            
                try {
                    if ($stmt->execute()) {
                        return $stmt->fetch(PDO::FETCH_ASSOC);
                } else {
                    throw new Exception("Get student info failed");
                }
        } catch (Exception $e) {
            error_log("Chyba u funkce getStudent, získaná dat selhalo\n", 3, "../errors/error.log");
            echo $e->getMessage();
        }
    }

/**
* Updatuje informace o žákovi v databázi
* @param object  $connection - napojení na databázi
* @param string  $first_name - Křestní jméno žáka
* @param string  $second_name - Druhé jméno žáka
* @param integer $age - Věk žáka
* @param string  $life - Informace o žákovi
* @param string  $college - Kolej žáka
* @param integer $id - ID žáka
* @return boolean true, pokud se update povedl, jinak false
*/

    public static function udpateStudent($connection, $first_name, $second_name, $age, $life, $college, $id)
    {

        $sql = "UPDATE student
                SET first_name = :first_name,
                    second_name = :second_name,
                    age = :age,
                    life = :life,
                    college = :college
                WHERE id = :id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":age", $age, PDO::PARAM_INT);
        $stmt->bindValue(":life", $life, PDO::PARAM_STR);
        $stmt->bindValue(":college", $college, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Update student info failed");}
        } catch (Exception $e) {
            error_log("Chyba u funkce updateStudent, získaná dat selhalo\n", 3, "../errors/error.log");
            echo $e->getMessage();
        }
    }

/**
* Vymaže studenta z databáze podle ID
* @param object $connection - napojení na databázi
* @param integer $id - id daného žáka
* @return boolean true, pokud se vymazání povedlo, jinak false
*/

    public static function deleteStudent($connection, $id)
    {
        $sql = "DELETE 
                FROM student 
                WHERE id = :id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Delete student info failed");
            }
        } catch( Exception $e) {
            error_log("Chyba u funkce deleteStudent, získaná dat selhalo\n", 3, "../errors/error.log");
            echo $e->getMessage();
        }
    }

/**
* Vrátí všechny žáky z databáze
* @param object $connection - napojení na databázi
* @return array pole objektů, kde každý objekt je jeden žák
*/

    public static function getALLStudents($connection, $columns = "*")
    {
        $sql = "SELECT $columns 
                FROM student";

        $stmt = $connection->prepare($sql);

        try {
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Get all students info failed");
            }
        } catch (Exception $e) {
            error_log("Chyba u funkce getALLStudents, získaná dat selhalo\n", 3, "../errors/error.log");
            echo $e->getMessage();
        }       
    }

/**
* Přidá žáka do databáze a přesměruje nás na profil žáka
* @param object $connection - napojení na databázi
* @param string $first name - křestní jméno žáka
* @param string $second name - druhé jméno žáka
* @param integer $age - věk žáka
* @param string $life - Informace o žákovi
* @param string $college - Kolej žáka
* @return integer id nově vytvořeného žáka
* 
*/

    public static function createStudent($connection, $first_name, $second_name, $age, $life, $college)
    {
        $sql = "INSERT INTO student (first_name, second_name, age, life, college )
        VALUES (:first_name, :second_name, :age, :life, :college)";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":age", $age, PDO::PARAM_INT);
        $stmt->bindValue(":life", $life, PDO::PARAM_STR);
        $stmt->bindValue(":college", $college, PDO::PARAM_STR);

        try {
            if ($stmt->execute()) {
                $id = $connection->lastInsertId();
                return $id;
            } else {
                throw new Exception("Create student info failed");
            }
        } catch (Exception $e) { 
            error_log("Chyba u funkce createStudent, získaná dat selhalo\n", 3, "../errors/error.log");
            echo $e->getMessage();    
        }
    }

}