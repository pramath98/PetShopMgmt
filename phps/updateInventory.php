
<?php
session_start();

$prod_id = $_POST['update_prod_id'];
$prod_name = $_POST['update_prod_name'];
$pet_name = $_POST['update_pet_name'];
$company_name = $_POST['update_company_name'];
$price = $_POST['update_price'];
$quantity = $_POST['update_quantity'];
$new_file_name = "";

require 'connect.php';

if(is_uploaded_file($_FILES['update_file_name']['tmp_name'])) {
    $file = $_FILES['update_file_name'];
    $folder_name = "product_images";
    $header_path = 'Location: /petshop_management/admin-inventory.html';
    include 'upload-image.php';
}

$fetch_pet_id_sql = 'SELECT animalid from animals where name="'.$pet_name.'"';
if ($fetch_pet_id_res = mysqli_query($conn, $fetch_pet_id_sql)) { 
    if (mysqli_num_rows($fetch_pet_id_res) > 0) { 
        $fetch_pet_id_row = mysqli_fetch_array($fetch_pet_id_res);
        $fetched_pet_id = $fetch_pet_id_row['animalid'];

        if($new_file_name != "") {
            $update_inventory_query="UPDATE products SET animalid = $fetched_pet_id, name = '$prod_name', company = '$company_name', qty = $quantity, mrp=$price, imagename = '$new_file_name' WHERE prodid = $prod_id;";
        }
        else {
            $update_inventory_query="UPDATE products SET animalid = $fetched_pet_id, name = '$prod_name', company = '$company_name', qty = $quantity, mrp=$price WHERE prodid = $prod_id;";
        }

        if ($conn->query($update_inventory_query) == TRUE) {
            $_SESSION["message"] = "Product updated successfully !!!";
            $update_orderlist_query="UPDATE orderlist SET prod_name = '$prod_name', prod_company = '$company_name' WHERE prodid = $prod_id;";
            if ($conn->query($update_orderlist_query) == TRUE) {
                $_SESSION["message_desc"] = "Orderlist also updated successfully !!!";
                //echo "Update successful !!!";
            }
            else{
                echo "ERROR: Could not able to execute $query2. ".mysqli_error($conn); 
                $_SESSION["message_desc"] = "Failed to update orderlist details !!!";
                //echo "Update failure !!!";
            }
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