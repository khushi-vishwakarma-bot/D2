<?php
session_start();
include('db.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // In production, use password_hash()

    // 1. Check if user exists
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // 2. If user exists, check password
        if ($password === $user['password']) {
            $_SESSION['user'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password for this email.";
        }
    } else {
        // 3. If user doesn't exist, register them automatically
        $insert = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if (mysqli_query($conn, $insert)) {
            $_SESSION['user'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $error = "Registration failed. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | DesiDelight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 380px; padding: 30px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.1); background: white; }
        .brand-name { font-weight: 800; color: #198754; text-decoration: none; font-size: 2rem; }
    </style>
</head>
<body>

<div class="card login-card text-center">
    <a href="index.php" class="brand-name">DesiDelight</a>
    <p class="text-muted small">Enter your details to Login or Sign Up</p>

    <?php if($error): ?>
        <div class="alert alert-danger py-2 small"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3 text-start">
            <label class="form-label small fw-bold">Email</label>
            <input type="email" name="email" class="form-control" required placeholder="example@mail.com">
        </div>
        <div class="mb-4 text-start">
            <label class="form-label small fw-bold">Password</label>
            <input type="password" name="password" class="form-control" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn btn-success w-100 shadow-sm">Enter Shop</button>
    </form>
    <p class="mt-3 text-muted x-small" style="font-size: 0.7rem;">New users will be registered automatically.</p>
</div>

</body>
</html>