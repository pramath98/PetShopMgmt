<?php

require 'connect.php';

$fetch_pet_id_sql = 'SELECT animalid from animals where name="'.$fetch_this_animal_id.'"';
if ($fetch_pet_id_res = mysqli_query($conn, $fetch_pet_id_sql)) { 
    if (mysqli_num_rows($fetch_pet_id_res) > 0) { 
        $fetch_pet_id_row = mysqli_fetch_array($fetch_pet_id_res);
        //echo $fetch_pet_id_row['animalid'];
        $fetched_pet_id = $fetch_pet_id_row['animalid'];
    }
    else{
        echo'Unknown Pet';
    }
}

?>