<?php

//session_start();

include 'connect.php';



if(isset($_SESSION['pet_id_filter_user'])) {
    $sql = 'SELECT * from products where animalid='.$_SESSION['pet_id_filter_user'].' AND name LIKE "%'.$_SESSION['prod_search'].'%" ORDER BY name';
}
else {
    $sql = 'SELECT * from products ORDER BY name';
}
if ($res = mysqli_query($conn, $sql)) { 
    if (mysqli_num_rows($res) > 0) {
        $sql1='SELECT * from cart WHERE userid="'.$userid.'"';
        $res1=mysqli_query($conn,$sql1);
        $cart_items= mysqli_num_rows($res1);
        echo '

        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light bg-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">PetShop</a>


	      <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link"><span>Hello, '.$_SESSION['user'].' </span></a></li>
            <li class="nav-item"><a href="myorders.html" class="nav-link"><span class="icon-shopping-bag"></span> Your Orders</a></li>
	          <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span>['.$cart_items.']</a></li>
            <li class="nav-item"><a href="phps/logout.php" class="nav-link">Log out <span class="icon-sign-out"></span></a></li>
            
	        </ul>
	      </div>
	    </div>
	  </nav>
        <section class="ftco-section ftco-animate" >
		<div class="parallax-img d-flex align-items-center" >
			<div class="container">
            <form action="phps/search-inventory-user.php" method="GET" id="search-inventory-user-form">
            <div class="form-group">
            <table> 
            <thead><tr>
                <th>
                    <input type="search" class="form-control" style="width:860px"placeholder="Search products..." name="prod_search" id="prod_search" required=""></input>
                </th>
                <th>
                            <select name="search" class ="form-control" id="pet_name" required="">
                        
            
              ';
      $operation="search"; include "phps/pet_list.php";

      echo '</select>

      </th>
        <th>
            <input type="submit" class="btn btn-primary py-2 px-3" style="left-align:8px" value="search">
            </input>
        </th>
        </tr>
        </thead>
        </table>
      </div>
      </div>
    </form>
      </div>
</div>
	  </section>
          <section class="ftco-section-md0 ftco-cart">
          <div class="container">
              <div class="row">
                  <div class="col-md-12 ftco-animate">
                      <div class="cart-list">
        
        
';
                        if(isset($_SESSION['pet_id_filter_user'])) {
                            $animal_id = $_SESSION['pet_id_filter_user'];
                            include 'fetch-pet-name.php';
                            echo '  <p>
                                    <div style="font-size: large;">
                                        Filter
                                    </div>
                                    <form action="phps/clear_pet_filter_user.php" method="GET">
                                        Animal: '.$fetched_pet_name.' &nbsp &nbsp Product: '.$_SESSION['prod_search'].'
                                        <input type="submit" class="btn btn-primary py-1 px-2" value="clear">
                                    </form>
                                    </p>    ';
                        }
                echo'
                <table class="table bg-light">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th colspan="2">Product</th>
                                <th>Pet</th>
                                <th>Price</th>
                                <th colspan="3">Quantity</th>
                                <th>&nbsp</th>
                                
                            </tr>
                            </thead>';

        while ($row = mysqli_fetch_array($res)) {

							echo'<tbody>
                                <tr class="text-center  ftco-animate">
									<td class="image-prod"><div class="img" style="background-image:url(images/product_images/'.$row['imagename'].');"></div></td>
									</td>
									<td class="product-name">
                                        <h3>'.$row['name'].'</h3>
                                        <p>Comapany: '.$row['company'].'</p>
                                    </td>
                                    
                                    <td class="price">
                                        <h4>';

                                            $animal_id = $row['animalid'];
                                            include 'fetch-pet-name.php';
                                            echo $fetched_pet_name;

                                    echo' </h4>
									</td>
									
									<td class="price"><h4>₹'.$row['mrp'].'</h4></td>
                                    
                                <form action="phps/add_to_cart.php" class="input-group col-md-8 d-flex mb-3" method="GET">
                                    <td class="price">
                                    
                                        <span class="input-group-btn mr-2">
                                            <button type="button" class="quantity-left-minus btn" name="decrement_count_'.$row['prodid'].'" id="decrement_count_'.$row['prodid'].'"  data-type="minus" data-field="" onclick="javascript:decrement_count(\'decrement_count_'.$row['prodid'].'\',\'qty_'.$row['prodid'].'\');">
                                                <i class="ion-ios-remove"></i>
                                            </button>
                                        </span>
                                    </td>
                                    <td class="price">
                                        <input type="text" name="qty" id="qty_'.$row['prodid'].'" class="form-control input-number" value="1" min="1" max="100">
                                    </td>
                                    <td class="price">
                                        <span class="input-group-btn ml-2">
                                            <button type="button" class="quantity-right-plus btn" id="increment_count_'.$row['prodid'].'" data-type="plus" data-field="" onclick="javascript:increment_count(\'increment_count_'.$row['prodid'].'\',\'qty_'.$row['prodid'].'\');">
                                            <i class="ion-ios-add"></i>
                                        </button>
                                        </span>
                                    </td>
                                  
                                    </td>
                                   
                                    <td>
                                        <input type="hidden" name="product" value="'.$row['name'].'"></input>
                                        <span class="input-group-btn mr-2">
                                            <input type="submit" class="btn btn-primary py-3 px-4" value="&nbsp Add to cart  &nbsp"></input>
                                        </span>
                                    </td>
                                </form>
                                        
                                ';

        
        }
                        echo'
                        </tr><!-- END TR-->
                        </tbody>
                        </table>
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
                            </tr>
                        </thead>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>'; unset($_SESSION['pet_id_filter_user']);
        unset($_SESSION['prod_search']);
    } 
} 
else { 
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
}
 
unset($_POST['search']);
mysqli_close($conn); 
?> 