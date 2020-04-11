<?php

//session_start();

include 'connect.php';


    $sql = 'SELECT * from cart WHERE userid="'.$_SESSION['userid'].'"';
    $total=0;

if ($res = mysqli_query($conn, $sql)) { 
    if (mysqli_num_rows($res) > 0) { 
                                    echo'<section class="ftco-section-md0 ftco-cart">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12 ftco-animate">
                                                        <div class="cart-list">   
                                                            <table class="table bg-light">
                                                                <thead class="thead-primary">
                                                                    <tr class="text-center">
                                                                        <th>&nbsp</th>
                                                                        <th colspan="2">Product</th>
                                                                        <th>Pet</th>
                                                                        <th>Quantity</th>
                                                                        <th class="price">
                                                                        </th>
                                                                    </tr>
                                                                </thead>';
        
                while ($row=mysqli_fetch_array($res)) {
                        $product_id=$row['prodid'];
                        $product_qty=$row['qty'];
                        $fetch_from_products='SELECT animalid,name,company,mrp,imagename from products WHERE prodid="'.$product_id.'"';
                            if($fetch_products_res = mysqli_query($conn,$fetch_from_products)){
                                if(mysqli_num_rows($fetch_products_res)>0){
                                    $product_row=mysqli_fetch_array($fetch_products_res);
                                    $animal_id=$product_row['animalid'];
                                    $product_name=$product_row['name'];
                                    $product_company=$product_row['company'];
                                    $product_mrp=$product_row['mrp'];
                                    $product_image=$product_row['imagename'];

                                    $fetch_from_animals='SELECT name from animals WHERE animalid="'.$animal_id.'"';
                                        if($fetch_animals_res = mysqli_query($conn,$fetch_from_animals)){
                                            if(mysqli_num_rows($fetch_animals_res)>0){
                                                $animal_row=mysqli_fetch_array($fetch_animals_res);
                                                $animal_name=$animal_row['name'];
                                                echo'<tbody>
                                    <tr class="text-center  ftco-animate">  
                                        
                                        <td class="image-prod"><div class="img" style="background-image:url(images/product_images/'.$product_image.');"></div></td>
                                        
                                        <td class="product-name">
                                            <h3>'.$product_name.'</h3>
                                            <p>Comapany: '.$product_company.'</p>
                                        </td>
                                        
                                        <td class="price">
                                            <p>';
                                                echo $animal_name;
    
                                        echo' </p>
                                        </td>
                                        
                                        <td class="price">₹'.$product_mrp.'</td>
                                        
                                        <td class="price">'.$product_qty.'</td>
                                        
                                    </tr><!-- END TR-->
                                    </tbody>';
                                    $subtotal=$product_qty*$product_mrp;
                                    $total=$total+$subtotal;
                                            }
                                        }
                                    
                                }
                            }
                                    
                
                }
                $_SESSION["total_amt"]=$total;
                                echo'
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="ftco-section ftco-cart">
			<div class="container">
				
    		<div class="row justify-content-end">
    			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate bg-light">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex">
    						<span>Subtotal</span>
    						<span>₹'.$total.'</span>
    					</p>
    					<p class="d-flex">
    						<span>Delivery</span>
    						<span>₹0.00</span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span>₹'.$total.'</span>
    					</p>
    				</div><form action="checkout">
                    <p class="text-center">
                    <input type="submit" class="btn btn-primary py-3 px-4" value="Proceed to checkout"></a></p>
					</form>
    			</div>
    		</div>
			</div>
		</section>
                
                
                
                ';

                        }else{
                                    echo '<section class="ftco-section ftco-cart">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12 ftco-animate">
                                                        <div class="cart-list">
                                                            <table class="table">
                                                                <thead class="thead-primary">
                                                                    <tr class="text-center">
                                                                        <th colspan="5">The cart is empty</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>';
                        }
                
    }else { 
        echo '<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th colspan="5">There is a problem with the connection!</th>
                            </tr>
                        </thead>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    } 

mysqli_close($conn); 
?> 