<?php

$fetch_pet_name_sql = 'SELECT name from animals where animalid="'.$animal_id.'"';
if ($fetch_pet_name_res = mysqli_query($conn, $fetch_pet_name_sql)) { 
    if (mysqli_num_rows($fetch_pet_name_res) > 0) { 
        $fetch_pet_name_row = mysqli_fetch_array($fetch_pet_name_res);
        //echo $fetch_pet_name_row['name'];
        $fetched_pet_name = $fetch_pet_name_row['name'];
    }
    else{
        echo'Unknown Pet';
    }
}

?>