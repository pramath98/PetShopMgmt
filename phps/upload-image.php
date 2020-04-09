
<?php

if(isset($folder_name) and isset($header_path)) {
    $allowed_file_types = array('image/jpeg','image/jpg','image/png','image/bmp');

    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_type = $file['type'];
    
    if(in_array($file_type,$allowed_file_types)) {
        $file_name_seperated = explode('.',$file_name);
        $file_ext = strtolower(end($file_name_seperated));
    
        if($file_error === 0) {
            if($file_size > 5000) {
                $new_file_name = uniqid('', true).".".$file_ext;
                $file_destination = "C:\wamp64\www\petshop_management\images\\".$folder_name."\\".$new_file_name;
    
                if(move_uploaded_file($file_tmp_name, $file_destination) != true) {
                    $_SESSION["message"] = "Failed to upload image.";
                    $_SESSION["message_desc"] = "Unable to move image in destination folder.";
                    header( $header_path );
                }   
            }
            else {
                $_SESSION["message"] = "File is too large.";
                $_SESSION["message_desc"] = "Maximum file size of 5MB(5000KB) allowed.";
                header( $header_path );
            }
        }
        else {
            $_SESSION["message"] = "Cannot upload this file.";
            $_SESSION["message_desc"] = "File may be corrupted or contains error.";
            header( $header_path );
        }
        
    }
    else {
        $_SESSION["message"] = "File type not allowed.";
        $_SESSION["message_desc"] = "Only 'jpg', 'jpeg', 'png' & 'bmp' file types allowed.";
        header( $header_path );
    }
}
else {
    $_SESSION["message"] = "Failed to upload image";
    $_SESSION["message_desc"] = "Define folder_name or header_path";
    header( $header_path );
}


?>

