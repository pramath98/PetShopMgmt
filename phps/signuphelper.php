<?php
//session_start();

require 'connect.php';

$fname=$_GET['fname'];
$lname=$_GET['lname'];
$emailid=$_GET['emailid'];
$password=$_GET['password'];
$password1=$_GET['password1'];


if($password != $password1){
	echo '<script>alert("Password Does not match!");</script>';
	//echo'Password not matched';
	//echo "Password does not match!";
	echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
}
else{
	$query="INSERT into user_details(userid,fname,lname,emailid) values ('','$fname','$lname','$emailid')";
	$query1="INSERT into credentials(userid,emailid,password) values ((select userid FROM user_details WHERE emailid='$emailid'),'$emailid','$password1')";

	if($conn->query($query)==TRUE){
		echo "user details updated!";
		if($conn->query($query1)==TRUE){
			echo "credentials updated!";
		}else{
			echo "cannot update credentials";
		}
	}else{
		echo "cannot update user details";
	}
}
?>