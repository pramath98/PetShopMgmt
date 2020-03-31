
<?php


$emailid = $_GET['emailid'];
$password = $_GET['password'];

require 'connect.php';

session_start();

$query= "SELECT emailid,password from credentials WHERE emailid='$emailid'";

//$res=$con->query($query);

if($res = mysqli_query($conn, $query)){
    $row = mysqli_fetch_array($res);
    if ( $password == $row['password']) {

        $_SESSION["user"] = "$row[emailid]";
        $_SESSION["message"] = "welcome, $row[emailid] ";
        //echo "Login successful!!";
        header("location: /petshop_management/home");
    }else{
        //echo "failure";
        $_SESSION["message"] = "Failed to login !!!";
        //echo $_SESSION["message"];
        header("location: /petshop_management/sign-in");
    }
}
?>

