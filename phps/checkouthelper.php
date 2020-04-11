<?php

session_start();

$fname=$_GET['fname'];
$lname=$_GET['lname'];
$country=$_GET['country'];
$street=$_GET['street'];
$apt=$_GET['apt'];
$city=$_GET['city'];
$zipcode=$_GET['zipcode'];
$phone=$_GET['phone'];
$email=$_GET['email'];
$optradio=$_GET['optradio'];
$userid=$_SESSION['userid'];
$user=$_SESSION['user'];

include 'connect.php';

$query="INSERT into address(fname,lname,country,street,apt,city,zipcode,phone,email,payment_method) values ('$fname','$lname','$country','$street','$apt','$city','$zipcode','$phone','$email','$optradio')";

if($res=mysqli_query($conn,$query)){
    $cart_query='SELECT * from cart WHERE userid="'.$userid.'"';

    if($cart_res=mysqli_query($conn,$cart_query)){
            while ($cart_row=mysqli_fetch_array($cart_res)) {
                $prodid=$cart_row['prodid'];
                $qty=$cart_row['qty'];
                $total_amt=$cart_row['mrp']*$qty;
                $prod_query='SELECT name,company from products where prodid='.$prodid.'';

                if($prod_res=mysqli_query($conn,$prod_query)){
        
                    $prod_row=mysqli_fetch_array($prod_res);
                    $prod_name=$prod_row['name'];
                    $prod_company=$prod_row['company'];
                    $order_query="INSERT into orderlist(orderid,userid,user_email,prodid,prod_name,prod_company,qty,total_amt,status) values ('','$userid','$user','.$prodid.','$prod_name','$prod_company','$qty','$total_amt','processing')";

                    if($order_res=mysqli_query($conn,$order_query)){
                        $cart_delete_query='DELETE from cart where prodid='.$prodid.' AND userid='.$userid.'';
            if($delete_res=mysqli_query($conn,$cart_delete_query)){
                  }
                    }
                }else{
                        echo "products data retrival failed!";
                }
            }
            $_SESSION["message"] = "Order Placed Successfully!";
            $_SESSION['message_desc']= "You can continue shopping!";
header("location:/petshop_management/home");
    
    }else{
        echo "Cart data retriaval failed!";
    }
}else{
    echo "fail".$conn->error;
}

?>