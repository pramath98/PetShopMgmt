<?php

$fetch_product_company_sql = 'SELECT company from products where prodid="'.$prod_id.'"';
if ($fetch_product_company_res = mysqli_query($conn, $fetch_product_company_sql)) { 
    if (mysqli_num_rows($fetch_product_company_res) > 0) { 
        $fetch_product_company_row = mysqli_fetch_array($fetch_product_company_res);
        echo $fetch_product_company_row['company'];
    }
    else{
        echo'(company name not available)';
    }
}
?>