<?php
session_start();

$prod_name = $_GET['prod_name'];
$pet_name = $_GET['pet_name'];
$company_name = $_GET['company_name'];
$price = $_GET['price'];
$quantity = $_GET['quantity'];
$image_name = $_GET['image_name'];

$fetch_this_animal_id = $pet_name;
include 'fetch-pet-id.php';

require 'connect.php';

$query="INSERT INTO products (animalid, name, company, qty, mrp, imagename) VALUES ($fetched_pet_id, '$prod_name', '$company_name', $quantity, $price, '$image_name')";
if ($conn->query($query) == TRUE) {
    $_SESSION["message"] = "New product inserted !!!";
    echo "Update successful !!!";
}
else{
    //echo "ERROR: Could not able to execute $query. ".mysqli_error($conn); 
    $_SESSION["message"] = "Failed to insert new product !!!";
    echo "Update failure !!!";
}
header( 'Location: /petshop_management/admin-inventory.html' );

?>