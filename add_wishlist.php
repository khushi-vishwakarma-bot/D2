<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

$query = "INSERT INTO wishlist(user_id, product_id)
          VALUES($user_id, $product_id)";

mysqli_query($conn, $query);

header("Location: products.php");
?>