<?php

session_start();

include 'connect.php';

$product=$_GET["prod_search"];
$pet=$_GET["search"];

$query = "SELECT animalid from animals where name='$pet'";

if($res=mysqli_query($conn,$query)){
    $row = mysqli_fetch_array($res);

    $_SESSION['pet_id_filter_user'] = "$row[animalid]";
    $_SESSION['prod_search'] = $product;
    header("location: /petshop_management/home");

}



?>