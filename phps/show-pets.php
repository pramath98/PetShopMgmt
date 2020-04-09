<?php

include 'connect.php';

$sql = 'SELECT * from animals ORDER BY name';
if ($res = mysqli_query($conn, $sql)) { 
    if (mysqli_num_rows($res) > 0) { 
        
        echo '<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th colspan="4">pet</th>
                                <th class="price">
                                    <a href="#" class="btn btn-primary py-1 px-4" data-toggle="modal" aria-pressed="false" data-target="#addNewPet">
                                        Add new pet
                                    </a>
                                </th>
                            </tr>
                            </thead>';

        while ($row = mysqli_fetch_array($res)) {

							echo'<tbody>
								<tr class="text-center  ftco-animate">

                                    <td class="product-remove">
                                        <a href="#" onclick="javascript:delete_form_variables(\''.$row['animalid'].'\');" data-toggle="modal" aria-pressed="false" data-target="#deletePetModal">
                                            <span class="ion-ios-close"></span>
                                        </a>
                                    </td>
									
									<td class="image-prod"><div class="img" style="background-image:url(images/pet_images/'.$row['imagename'].');"></div></td>
									
									<td class="product-name">
										<h3>'.$row['name'].'</h3>
                                    </td>

                                    <td class="product-name">
                                        <form action="phps/set_pet_filter.php" method="GET">
                                        <div class="form-group" style="display: none;">
                                            <input type="text" class="form-control border" placeholder=" " name="animal_id_for_filter" id="animal_id_for_filter" value="'.$row['animalid'].'">
                                        </div>
                                        <input type="submit" class="btn btn-primary py-2 px-4" value="show products">
                                        </form>
                                    </td>
                                    
                                    <td class="price">
                                        <p class="text-center">
                                        <a href="#" onclick="javascript:update_form_variables(\''.$row['animalid'].'\',\''.$row['name'].'\');" class="btn btn-primary py-3 px-4" data-toggle="modal" aria-pressed="false" data-target="#updatePet">
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
        echo "<h4 class='sub-title py-3'>";  
        echo "No product found."; 
        echo "</h4>";
    } 
} 
else { 
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn); 
}
 
unset($_POST['search']);
mysqli_close($conn); 
?> 