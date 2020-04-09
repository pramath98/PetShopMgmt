<?php

//session_start();

include 'connect.php';

if(isset($_SESSION['pet_id_filter'])) {
    $sql = 'SELECT * from products where animalid='.$_SESSION['pet_id_filter'].' ORDER BY name';
}
else {
    $sql = 'SELECT * from products ORDER BY name';
}
if ($res = mysqli_query($conn, $sql)) { 
    if (mysqli_num_rows($res) > 0) { 
        
        echo '<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">';
                        if(isset($_SESSION['pet_id_filter'])) {
                            $animal_id = $_SESSION['pet_id_filter'];
                            include 'fetch-pet-name.php';
                            echo '  <p>
                                    <div style="font-size: large;">
                                        Filter
                                    </div>
                                    <form action="phps/clear_pet_filter.php" method="GET">
                                        Animal: '.$fetched_pet_name.' &nbsp &nbsp
                                        <input type="submit" class="btn btn-primary py-1 px-2" value="clear">
                                    </form>
                                    </p>    ';
                        }
                echo'   <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp</th>
                                <th colspan="2">Product</th>
                                <th>Pet</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="price">
                                    <a href="#" class="btn btn-primary py-1 px-4" data-toggle="modal" aria-pressed="false" data-target="#addNewInventory">
                                        Add new item
                                    </a>
                                </th>
                            </tr>
                            </thead>';

        while ($row = mysqli_fetch_array($res)) {

							echo'<tbody>
                                <tr class="text-center  ftco-animate">
                                
                                    <td class="product-remove">
                                        <a href="#" onclick="javascript:delete_form_variables(\''.$row['prodid'].'\');" data-toggle="modal" aria-pressed="false" data-target="#deleteInventoryModal">
                                            <span class="ion-ios-close"></span>
                                        </a>
                                    </td>   
									
									<td class="image-prod"><div class="img" style="background-image:url(images/product_images/'.$row['imagename'].');"></div></td>
									
									<td class="product-name">
                                        <h3>'.$row['name'].'</h3>
                                        <p>Comapany: '.$row['company'].'</p>
                                    </td>
                                    
                                    <td class="price">
                                        <p>';

                                            $animal_id = $row['animalid'];
                                            include 'fetch-pet-name.php';
                                            echo $fetched_pet_name;

                                    echo' </p>
									</td>
									
									<td class="price">Rs. '.$row['mrp'].'</td>
									
									<td class="price">'.$row['qty'].'</td>
                                    
                                    <td class="price">
                                        <p class="text-center">
                                            <a href="#" onclick="javascript:update_form_variables(\''.$row['prodid'].'\',\''.$row['name'].'\',\''.$fetched_pet_name.'\',\''.$row['company'].'\',\''.$row['mrp'].'\',\''.$row['qty'].'\');" class="btn btn-primary py-3 px-4" data-toggle="modal" aria-pressed="false" data-target="#updateInventory">
                                                &nbsp Update &nbsp
                                            </a>
                                        </p>
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
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th colspan="5">No product found</th>
                                <th class="price">
                                    <a href="#" class="btn btn-primary py-1 px-4" data-toggle="modal" aria-pressed="false" data-target="#addNewInventory">
                                        Add new item
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>';;
    } 
} 
else { 
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
}
 
unset($_POST['search']);
mysqli_close($conn); 
?> 