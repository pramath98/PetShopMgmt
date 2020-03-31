
<?php
session_start();

$prod_id = $_GET['delete_prod_id'];

require 'connect.php';

$fetch_pending_orders_query='SELECT * FROM orderlist WHERE prodid = '.$prod_id.' AND status = "processing";';

if ($fetch_pending_orders_res = mysqli_query($conn, $fetch_pending_orders_query)) { 
    if (mysqli_num_rows($fetch_pending_orders_res) > 0) { 
        $_SESSION["message"] = "You cannot delete this product.";
        $_SESSION['message_desc'] = "Mark orders of this product as shipped.";
    }
    else{
        $delete_product_query="DELETE FROM products WHERE prodid = $prod_id;";
        if ($conn->query($delete_product_query) == TRUE) {
            $_SESSION["message"] = "Product deleted successfully !!!";
        }
        else{
            $_SESSION["message"] = "Failed to delete Product !!!";
            //echo "Update failure !!!";
        }
    }
}
else {
    $_SESSION["message"] = "Failed to fetch pending orders !!!";
}

header( 'Location: /petshop_management/admin-inventory.html' );

?>