<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="login-page">

    <div class="page-overlay"></div>

    <div class="login-container">
        <div class="help-icon">?</div>

        <h1 class="login-title">LOG IN</h1>

        <form action="process_login.php" method="POST" class="login-form">
            <div class="input-line">
                <input type="email" name="email" required>
                <label>Username</label>
            </div>

          <div class="input-line password-field">
    <input type="password" id="loginPassword" name="password" required>
    <label>Password</label>

    <span class="eye-icon"
        onmousedown="showPassword('loginPassword')"
        onmouseup="hidePassword('loginPassword')"
        onmouseleave="hidePassword('loginPassword')"
        ontouchstart="showPassword('loginPassword')"
        ontouchend="hidePassword('loginPassword')">
        👁
    </span>
</div>

           <button type="submit" class="login-btn">SIGN IN</button>

            <p class="forgot-text">Forgot Password</p>

            <p class="bottom-text">
                Don`t have an account?
                <a href="register.php">Create</a>
            </p>
        </form>
    </div>

    <script src="../assets/script.js"></script>
</body>
</html>