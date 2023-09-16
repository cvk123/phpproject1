<?php

require "../classes/Database.php";
require "../classes/Image.php";
require "../classes/Auth.php";
require "../classes/Url.php";

session_start();

if (!Auth::isLoggedIn()) {
    die(header("Location:../signin.php"));
}

$connection = (new Database())->connectionDB();

$user_id = $_GET["id"];
$image_name = $_GET["image_name"];

$image_path = "../uploads/" . $user_id . "/" . $image_name;

if (Image::deletePhotoFromDirectory($image_path)) {
   Image::deletePhotoFromDatabase($connection, $image_name);
    Url::redirectUrl("/skola-project/admin/photos.php");
} else {
    
}