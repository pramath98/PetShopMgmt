<?php
session_start();

$pet_name = $_GET['pet_name'];
$image_name = $_GET['image_name'];

require 'connect.php';

$query="INSERT INTO animals (name, imagename) VALUES ('$pet_name', '$image_name');";
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