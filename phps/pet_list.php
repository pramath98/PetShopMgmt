<?php

require 'connect.php';

$fetch_pet_names_sql = 'SELECT name from animals;';
if ($fetch_pet_names_res = mysqli_query($conn, $fetch_pet_names_sql)) { 
    if (mysqli_num_rows($fetch_pet_names_res) > 0) {
        if ($operation == "add") {
            echo '<option value="" disabled selected>Select pet</option>';
        }
        if ($operation == "search") {
            echo '<option value="" disabled selected >Select a pet</option>';
        }

        while ($fetched_pet_name_row = mysqli_fetch_array($fetch_pet_names_res)) {
            echo '<option value="'.$fetched_pet_name_row['name'].'" id="'.$fetched_pet_name_row['name'].'">'.$fetched_pet_name_row['name'].'</option>';
        }
    }
    else{
        echo'<option value="" disabled selected>No pet found</option>';
    }
}
else{
  echo '<option value="" disabled selected>Unable to fetch pets</option>';
}

?>