<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    echo "Please login first.";
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT p.* FROM wishlist w 
          JOIN products p ON w.product_id = p.id
          WHERE w.user_id = $user_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Wishlist</title>

<style>
body{
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg,#ff9a9e,#fad0c4);
    margin:0;
}

.container{
    padding:20px;
}

h1{
    text-align:center;
    color:white;
}

.card{
    background:white;
    border-radius:18px;
    padding:15px;
    margin:15px 0;
    display:flex;
    align-items:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
}

.card img{
    width:90px;
    height:90px;
    border-radius:12px;
    object-fit:cover;
    margin-right:15px;
}

.info{
    flex:1;
}

.name{
    font-weight:600;
    font-size:18px;
}

.price{
    color:#ff4d6d;
    font-weight:bold;
}

.btn{
    background:#ff4d6d;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:10px;
    cursor:pointer;
}
</style>

</head>

<body>

<div class="container">
<h1>❤️ My Wishlist</h1>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="card">

<img src="<?php echo $row['image']; ?>">

<div class="info">
<div class="name"><?php echo $row['name']; ?></div>
<div class="price">₹<?php echo $row['price']; ?></div>
</div>

<form action="remove_wishlist.php" method="POST">
<input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
<button class="btn">Remove</button>
</form>

</div>

<?php } ?>

</div>

</body>
</html>