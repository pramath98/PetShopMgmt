
<?php


$emailid = $_GET['emailid'];
$password = $_GET['password'];

require 'connect.php';

session_start();

$query= "SELECT emailid,password from credentials WHERE emailid='$emailid'";
$query1= "SELECT userid,fname from user_details WHERE emailid='$emailid'";

//$res=$con->query($query);

if($res = mysqli_query($conn, $query)){
    $row = mysqli_fetch_array($res);
    if ( $password == $row['password']) {
        $res1 = mysqli_query($conn,$query1);
        $row1 = mysqli_fetch_array($res1);
        $_SESSION["user"] = "$row1[fname]";
        $_SESSION["userid"] = "$row1[userid]";
        header("location: /petshop_management/home");
    }else{
        //echo "failure";
        $_SESSION["message"] = "Failed to login !!!";
        //echo $_SESSION["message"];
       header("location: /petshop_management/index.html");
    }
}
?>

