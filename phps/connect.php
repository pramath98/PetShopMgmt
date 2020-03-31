<?php

$conn = new mysqli('localhost','root','','id13016609_petshopmgmt');
if ($conn->connect_error) {
    die("Connection failed!" . $conn->connect_error);
}

?>