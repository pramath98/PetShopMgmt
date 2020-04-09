<?php
session_start();

$order_id = $_GET['order_id'];
$prod_id = $_GET['prod_id'];
$qty = (int)$_GET['qty'];

require 'connect.php';

$get_Inventory_Count_Query = "SELECT qty from products where prodid='$prod_id';";
if ($get_Inventory_Count_res = mysqli_query($conn, $get_Inventory_Count_Query)) { 
    if (mysqli_num_rows($get_Inventory_Count_res) > 0) { 
        $get_Inventory_Count_row = mysqli_fetch_array($get_Inventory_Count_res);
        $inventory_count = (int)$get_Inventory_Count_row['qty'];
        if ($inventory_count >= $qty) {
			$update_inventory_count_query = "UPDATE products SET qty = qty - $qty WHERE prodid = $prod_id;";
			if ($conn->query($update_inventory_count_query) == TRUE) {
				$update_order_status_query = "UPDATE orderlist SET status = 'shipped' WHERE orderid = $order_id;";
				if ($conn->query($update_order_status_query) == TRUE) {
					$_SESSION["message"] = "Order successfully marked as shipped !";
				}
				else {
					$_SESSION["message"] = "Failed to update order status !";
				}
			}
			else {
			$_SESSION["message"] = "Failed to update quantity";
			}
		}
		else {
			$_SESSION["message"] = "Insufficient product quantity in inventory.<br/>Update quantity of product.";
		}
	}
    else{
        $_SESSION["message"] = "Product not found.<br/> Please insert product first.";
    }
}
else {
    $_SESSION["message"] = "Unable to fetch Inventory count";
}
header( 'Location: /petshop_management/admin-orders.html' );
?>