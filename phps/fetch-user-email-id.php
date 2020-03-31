<?php

$fetch_user_email_id_sql = 'SELECT emailid from user_details where userid="'.$user_id.'"';
if ($fetch_user_email_id_res = mysqli_query($conn, $fetch_user_email_id_sql)) { 
    if (mysqli_num_rows($fetch_user_email_id_res) > 0) { 
        $fetch_user_email_id_row = mysqli_fetch_array($fetch_user_email_id_res);
        echo $fetch_user_email_id_row['emailid'];
    }
    else{
        echo'(user email ID not available)';
    }
}
?>