<?php

session_start();

if(isset($_SESSION['pet_id_filter_user'])) {
    unset($_SESSION['pet_id_filter_user']);
    unset($_SESSION['prod_search']);
}

header("location: /petshop_management/home");

?>