<?php

$fetch_product_name_sql = 'SELECT name from products where prodid="'.$prod_id.'"';
if ($fetch_product_name_res = mysqli_query($conn, $fetch_product_name_sql)) { 
    if (mysqli_num_rows($fetch_product_name_res) > 0) { 
        $fetch_product_name_row = mysqli_fetch_array($fetch_product_name_res);
        echo $fetch_product_name_row['name'];
    }
    else{
        echo'(product name not available)';
    }
}
?>