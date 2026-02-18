<?php
include "db.php"; // uses your database connection

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO feedback (name, email, message) 
            VALUES ('$name', '$email', '$message')";
    mysqli_query($conn, $sql);

    echo "<script>alert('Thank you for your feedback!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <style>
        body{
            font-family: Arial;
            background:#f4f4f4;
        }
        .box{
            width:350px;
            margin:80px auto;
            padding:20px;
            background:white;
            border-radius:10px;
            box-shadow:0 0 10px gray;
        }
        input, textarea{
            width:100%;
            padding:10px;
            margin:8px 0;
        }
        button{
            width:100%;
            padding:10px;
            background:#28a745;
            color:white;
            border:none;
            font-size:16px;
            border-radius:5px;
        }
    </style>
</head>

<body>

<div class="box">
<h2>Give Your Feedback</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Your Name" required>
    
    <input type="email" name="email" placeholder="Your Email" required>
    
    <textarea name="message" placeholder="Your Feedback" required></textarea>
    
    <button name="submit">Submit</button>
</form>

</div>

</body>
</html>
