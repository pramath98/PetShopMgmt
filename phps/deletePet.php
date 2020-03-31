
<?php
session_start();

$pet_id = $_GET['delete_pet_id'];

require 'connect.php';

$fetch_pending_orders_query='SELECT * FROM orderlist WHERE prodid = '.$pet_id.' AND status = "processing";';

if ($fetch_pending_orders_res = mysqli_query($conn, $fetch_pending_orders_query)) { 
    if (mysqli_num_rows($fetch_pending_orders_res) > 0) { 
        $_SESSION["message"] = "You cannot delete this pet.";
        $_SESSION['message_desc'] = "Mark order with products of this pet as shipped.";
    }
    else{
        $query="DELETE FROM animals WHERE animalid = $pet_id;";
        if ($conn->query($query) == TRUE) {
            $_SESSION["message"] = "Pet deleted successfully !!!";
        }
        else{
            $_SESSION["message"] = "Failed to delete pet !!!";
        }
    }
}
else {
    $_SESSION["message"] = "Failed to fetch pending orders !!!";
}

header( 'Location: /petshop_management/admin-pets.html' );

?>