<?php

session_start();
unset($_SESSION['user']);
    session_destroy();
echo "Session Destroyed successfully!";
?>