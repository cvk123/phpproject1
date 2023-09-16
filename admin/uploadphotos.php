<?php

    require "../classes/Database.php";
    require "../classes/Auth.php";
    require "../classes/Url.php";
    require "../classes/Image.php";

    session_start();

    // If user is not logged in, redirect to login page
    if (!Auth::isLoggedIn()) {
        die(header("Location:../signin.php"));    
    }

    $user_id = $_SESSION["logged_in_user"];

    if(isset($_POST["submit"]) && isset($_FILES["image"])){
        
        $connection = (new Database())->connectionDB();

        $image_name = $_FILES["image"]["name"];
        $image_size = $_FILES["image"]["size"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $error = $_FILES["image"]["error"];

        if($error === 0) {
            if ($image_size > 1250000) {
                Url::redirectUrl("/skola-project/errors/error-page.php?error_text=Obrázek je příliš velký");
            } else {
                $allowed = pathinfo($image_name, PATHINFO_EXTENSION);
                $allowed_lower_case = strtolower($allowed);
                $allowed_extensions = ["jpg", "jpeg", "png", "gif", "jfif", "webp", "svg", "avif"];

                if(in_array($allowed_lower_case,  $allowed_extensions)){
                    // Create unique name for image
                    $new_image_name = uniqid("IMG_", true) . "." . $allowed_lower_case;
                    
                    // Move image to uploads folder
                    if(!file_exists("../uploads/$user_id")){
                        mkdir("../uploads/$user_id", 0777, true);
                    }

                    $image_upload_path = "../uploads/$user_id/$new_image_name";
                    move_uploaded_file($image_tmp, $image_upload_path);

                    // Insert image name into database
                    if(Image::insertImage($connection, $user_id, $new_image_name)){
                        Url::redirectUrl("/skola-project/admin/photos.php");
                    } else {
                        $error_msg = "Nepodařilo se vložit obrázek do databáze";
                        echo $error_msg;
                    }
                    
                } else {
                    $error_msg = "Soubor není ve správném formátu";
                    echo $error_msg;                   
                }
            }
        } else {
           Url::redirectUrl("/skola-projekt/admin/photos.php");
        }
    }
    