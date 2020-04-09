<?php
session_start();

$pet_name = $_POST['pet_name'];
$new_file_name = "";


$file = $_FILES['file_name'];
$folder_name = "pet_images";
$header_path = 'Location: /petshop_management/admin-inventory.html';
include 'upload-image.php';

require 'connect.php';

$query="INSERT INTO animals (name, imagename) VALUES ('$pet_name', '$new_file_name');";
if ($conn->query($query) == TRUE) {
    $_SESSION["message"] = "New pet inserted !!!";
    //echo "Update successful !!!";
}
else{
    $_SESSION["message"] = "Failed to insert pet !!!";
    //echo "Update failure !!!";
}
header( 'Location: /petshop_management/admin-pets.html' );

?>