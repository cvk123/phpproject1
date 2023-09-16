<?php

class Image {

    /**
     * Insert image into database
     * @param PDO $connection
     * @param int $user_id
     * @param string $image_name
     * @return bool
     */
    public static function insertImage($connection, $user_id, $image_name){
        $sql = "INSERT INTO image (user_id, image_name) 
                VALUES (:user_id, :image_name)";

        $stmt = $connection->prepare($sql);
        
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":image_name", $image_name, PDO::PARAM_STR);
        
        if($stmt->execute()){
            return true;
        } 
     }

     /**
      * Get image by user id
      * @param PDO $connection
      * @param int $user_id
      * @return $images
      */
     public static function getImageByUserId($connection, $user_id){
        $sql = "SELECT image_name 
                FROM image 
                WHERE user_id = :user_id";      

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);  
        $stmt->execute();    
        
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $images;
     }

     /**
      * Delete image from Directory
      * @param PDO $connection
      * @param string $image_name
      * @return bool
      */

      public static function deletePhotoFromDirectory($image_name){
        try {
            if(!file_exists($image_name)){
                throw new Exception("File does not exist");
            }

            if(unlink($image_name)){
                return true;
            } else {
                throw new Exception("File was not deleted");
            }
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
      }

        /**
         * Delete image from database
         * @param PDO $connection
         * @param int $user_id
         * @param string $image_name
         * @return bool
         */
      public static function deletePhotoFromDatabase($connection, $image_name){
        $sql = "DELETE FROM image 
                WHERE image_name = :image_name";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":image_name", $image_name, PDO::PARAM_STR);

        if(!$stmt->execute()){
            throw new Exception("Image was not deleted from database");
        } else {
            return true;
            echo "Image was deleted from database";
        }
      }

}