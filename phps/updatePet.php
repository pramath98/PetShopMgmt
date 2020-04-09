
<?php
session_start();

$pet_id = $_POST['update_pet_id'];
$pet_name = $_POST['update_pet_name'];
$new_file_name = "";

require 'connect.php';

if(is_uploaded_file($_FILES['update_file_name']['tmp_name'])) {
    $file = $_FILES['update_file_name'];
    $folder_name = "pet_images";
    $header_path = 'Location: /petshop_management/admin-pets.html';
    include 'upload-image.php';
}

require 'connect.php';

if($new_file_name != "") {
    $query="UPDATE animals SET name = '$pet_name', imagename='$new_file_name' WHERE animalid = $pet_id;";
}
else {
    $query="UPDATE animals SET name = '$pet_name' WHERE animalid = $pet_id;";
}

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