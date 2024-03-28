<?php
    session_start();
    include('execution-functions.php');
    $productId = $_GET['productId'];
    array_push($_SESSION['cart-items-array'],$productId);
    echo "<script>window.close()</script>";
?>