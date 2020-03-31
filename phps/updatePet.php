
<?php
session_start();

$pet_id = $_GET['update_pet_id'];
$pet_name = $_GET['update_pet_name'];

require 'connect.php';

$query="UPDATE animals SET name = '$pet_name' WHERE animalid = $pet_id;";
if ($conn->query($query) == TRUE) {
    $_SESSION["message"] = "Pet details updated successfully !!!";
    //echo "Update successful !!!";
}
else{
    $_SESSION["message"] = "Failed to update pet details !!!";
    //echo "Update failure !!!";
}
header( 'Location: /petshop_management/admin-pets.html' );

?>