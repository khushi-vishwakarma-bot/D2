<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

$query = "DELETE FROM wishlist 
          WHERE user_id=$user_id 
          AND product_id=$product_id";

mysqli_query($conn, $query);

header("Location: wishlist.php");
?>