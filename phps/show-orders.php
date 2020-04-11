<?php

include 'connect.php';

$processingOrders = 'SELECT * from orderlist where status="processing" ORDER BY prodid DESC';
if ($processingOrdersRes = mysqli_query($conn, $processingOrders)) { 
    if (mysqli_num_rows($processingOrdersRes) > 0) { 
        
        echo '<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <h3 class="text-center">
                            New Orders
                        </h3>
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>';

        while ($processingOrdersRow = mysqli_fetch_array($processingOrdersRes)) {

							echo'<tbody>
								<tr class="text-center">
									
									<td class="price">
										<p>'.$processingOrdersRow['orderid'].'</p>
                                    </td>
                                    
                                    <td class="price">
                                        <p>

                                        '.$processingOrdersRow['user_email'].'
                                        
                                        </p>
									</td>
									
                                    <td class="product-name">

                                        '.$processingOrdersRow['prod_name'].'
                                
                                    <br/>
                                    Company: &nbsp

                                        '.$processingOrdersRow['prod_company'].'

                                    </td>

                                    <td class="price">
                                        <h3>'.$processingOrdersRow['qty'].'</h3>
                                    </td>
                                        
                                    <td class="product-remove">
                                        <form  action="phps/orderShipped.php" method="GET">
                                        <div style="display: none;">
                                            <input type="text" placeholder="" name="order_id" id="order_id" required="" value="'.$processingOrdersRow['orderid'].'">
                                        </div>
                                        <div style="display: none;">
                                            <input type="text" placeholder="" name="prod_id" id="prod_id" required="" value="'.$processingOrdersRow['prodid'].'">
                                        </div>
                                        <div style="display: none;">
                                            <input type="text" placeholder="" name="qty" id="qty" required="" value="'.$processingOrdersRow['qty'].'">
                                        </div>
                                            <input type="submit" class="btn btn-primary py-2 px-4" value="mark as shipped">
                                        </form>
                                    </td>
									
								</tr><!-- END TR-->
								</tbody>';
        
        }
                        echo'</table>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    } 
    else { 

        echo '<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                    <h3 class="text-center">
                        New Orders
                    </h3>
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>No new orders found</th>
                            </tr>
                        </thead>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    } 
} 
else { 
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
}


$shippedOrders = 'SELECT * from orderlist where status="shipped" ORDER BY orderid DESC';
$invoice_amount = 0;
if ($shippedOrdersRes = mysqli_query($conn, $shippedOrders)) { 
    if (mysqli_num_rows($shippedOrdersRes) > 0) { 
        
        echo '<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <h3 class="text-center">
                            Shipped Orders
                        </h3>
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>';

        while ($shippedOrdersRow = mysqli_fetch_array($shippedOrdersRes)) {

							echo'<tbody>
								<tr class="text-center">
									
                                <td class="price">
                                    <p>'.$shippedOrdersRow['orderid'].'</p>
                                </td>
                                
                                <td class="price">
                                    <p>

                                    '.$shippedOrdersRow['user_email'].'
                                    
                                    </p>
                                </td>
                                
                                <td class="product-name">

                                    '.$shippedOrdersRow['prod_name'].'
                            
                                <br/>
                                Company: &nbsp

                                    '.$shippedOrdersRow['prod_company'].'

                                </td>

                                    <td class="price">
                                        <h3>'.$shippedOrdersRow['qty'].'</h3>
                                    </td>
                                        
                                    <td class="price">
                                        <p class="text-center">
                                            Shipped
                                        </p>
                                    </td>
									
								</tr><!-- END TR-->
                                </tbody>';
            $invoice_amount = $invoice_amount + $shippedOrdersRow['total_amt'];
        
        }
                        echo'</table>
                        </div>
                    </div>
                </div>

            <div class="row justify-content-end">
    			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Sales</h3>
    					<hr>
    					<p class="d-flex">
    						<span>Total Shipped Orders</span>
    						<span>'.mysqli_num_rows($shippedOrdersRes).'</span>
    					</p>
    					<p class="d-flex total-price">
    						<span>Total Earning</span>
    						<span>₹'.$invoice_amount.'</span>
    					</p>
    				</div>
    			</div>
            </div>
            </div>
            
        </section>';
    } 
    else { 

        echo '<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                    <h3 class="text-center">
                        Shipped Orders
                    </h3>
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>No shipped orders found</th>
                            </tr>
                        </thead>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    } 
} 
else { 
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
}
 
unset($_POST['search']);
mysqli_close($conn); 
?> 