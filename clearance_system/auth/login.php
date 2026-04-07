<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="bg-page">

    <div class="overlay-box login-box">
        <h1 class="form-title">LOG IN</h1>

        <form action="process_login.php" method="POST" class="form-area">
            <div class="input-group">
                <input type="email" name="email" placeholder=" " required>
                <label>Email</label>
            </div>

            <div class="input-group password-group">
                <input type="password" name="password" id="loginPassword" placeholder=" " required>
                <label>Password</label>
                <span class="toggle-password" onclick="togglePassword('loginPassword', this)">👁</span>
            </div>

            <button type="submit" class="green-btn">SIGN IN</button>
        </form>

        <p class="text-link1">Forgot Password</p>
        <p class="text-link">
            Don’t have an account?
            <a href="register.php">Create</a>
        </p>
    </div>

    <script src="../assets/script.js"></script>
</body>
</html>

