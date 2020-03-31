
<?php


$emailid = $_GET['username'];
$password = $_GET['password'];
//require 'connect.php';

session_start();

//$query= "SELECT emailid,password from credentials WHERE emailid='$emailid'";

//$res=$con->query($query);

if($emailid=="admin" && $password=="admin123"){
    $_SESSION["admin"] = "admin";
    header('location: /petshop_management/admin-inventory.html');}
else{
        echo "failure";
    }

?>

