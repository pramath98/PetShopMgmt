
<?php
session_start();

$prod_id = $_GET['update_prod_id'];
$prod_name = $_GET['update_prod_name'];
$pet_name = $_GET['update_pet_name'];
$company_name = $_GET['update_company_name'];
$price = $_GET['update_price'];
$quantity = $_GET['update_quantity'];

require 'connect.php';

$fetch_pet_id_sql = 'SELECT animalid from animals where name="'.$pet_name.'"';
if ($fetch_pet_id_res = mysqli_query($conn, $fetch_pet_id_sql)) { 
    if (mysqli_num_rows($fetch_pet_id_res) > 0) { 
        $fetch_pet_id_row = mysqli_fetch_array($fetch_pet_id_res);
        $fetched_pet_id = $fetch_pet_id_row['animalid'];

        $query2="UPDATE products SET animalid = $fetched_pet_id, name = '$prod_name', company = '$company_name', qty = $quantity, mrp=$price WHERE prodid = $prod_id;";
        if ($conn->query($query2) == TRUE) {
            $_SESSION["message"] = "Product updated successfully !!!";
            //echo "Update successful !!!";
        }
        else{
            echo "ERROR: Could not able to execute $query2. ".mysqli_error($conn); 
            $_SESSION["message"] = "Failed to update product details !!!";
            //echo "Update failure !!!";
        }

    }
    else{
        $_SESSION["message"] = "Unknown Pet, Add pet first";
    }
}


header( 'Location: /petshop_management/admin-inventory.html' );

?>