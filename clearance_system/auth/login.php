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
            <a href="#" id="forgotPasswordBtn" class="forgot-link">Forgot Password</a>
        </form>

        <p class="text-link">
            Don’t have an account?
            <a href="register.php">Create</a>
        </p>
    </div>

    <script src="../assets/script.js"></script>
    <!-- Forgot Password Modal -->
<div id="forgotModal" class="modal-overlay">
    <div class="forgot-modal-box">
        <span class="close-modal" id="closeForgotModal">&times;</span>
        <span class="question-icon" id="openContactModal">?</span>

        <h2>Forgot Password?</h2>

        <div class="forgot-content">
            <p><span class="red-mark">!</span>Password reset is managed by the administrator.</p>
            <p>Kindly contact the admin for assistance.</p>
            <p>Please click the question mark reminder for your OLD PASSWORD.</p>
        </div>
    </div>
</div>
<!-- Contact Us Modal -->
<div id="contactModal" class="modal-overlay">
    <div class="contact-modal-box">
        <span class="contact-close" id="closeContactModal">&times;</span>

        <h2>CONTACT US</h2>

<div class="contact-cards">
    <div class="contact-card">
        <div class="profile-icon">
            <img src="../assets/gian.jpg" alt="Gian Esio">
        </div>
        <h3>GIAN ESIO</h3>
        <p><strong>NO.</strong><br>09851642711</p>
        <p><strong>FB:</strong><br>GIAN ESIO</p>
        <p><strong>GMAIL:</strong><br>c23-4908-01</p>
    </div>

    <div class="contact-card">
        <div class="profile-icon">
            <img src="../assets/mark.jpg" alt="Mark Paredes">
        </div>
        <h3>MARK PAREDES</h3>
        <p><strong>NO.</strong><br>09925383649</p>
        <p><strong>FB:</strong><br>MARK PAREDES</p>
        <p><strong>GMAIL:</strong><br>c23-4908-02</p>
    </div>

    <div class="contact-card">
        <div class="profile-icon">
            <img src="../assets/cj.jpg" alt="CJ Balog">
        </div>
        <h3>CJ BALOG</h3>
        <p><strong>NO.</strong><br>09602097975</p>
        <p><strong>FB:</strong><br>CJ BALOG</p>
        <p><strong>GMAIL:</strong><br>c23-4908-03</p>
    </div>

    <div class="contact-card">
        <div class="profile-icon">
            <img src="../assets/gerald.jpg" alt="Gerald Mamay">
        </div>
        <h3>GERALD MAMAY</h3>
        <p><strong>NO.</strong><br>09477893124</p>
        <p><strong>FB:</strong><br>HERALDO</p>
        <p><strong>GMAIL:</strong><br>c23-4908-04</p>
    </div>
</div>
    </div>
</div>
<script>
    const forgotBtn = document.getElementById("forgotPasswordBtn");
    const forgotModal = document.getElementById("forgotModal");
    const closeForgotModal = document.getElementById("closeForgotModal");

    const openContactModal = document.getElementById("openContactModal");
    const contactModal = document.getElementById("contactModal");
    const closeContactModal = document.getElementById("closeContactModal");

    forgotBtn.addEventListener("click", function(e) {
        e.preventDefault();
        forgotModal.classList.add("show");
    });

    closeForgotModal.addEventListener("click", function() {
        forgotModal.classList.remove("show");
    });

    forgotModal.addEventListener("click", function(e) {
        if (e.target === forgotModal) {
            forgotModal.classList.remove("show");
        }
    });

    openContactModal.addEventListener("click", function() {
        forgotModal.classList.remove("show");
        contactModal.classList.add("show");
    });

    closeContactModal.addEventListener("click", function() {
        contactModal.classList.remove("show");
        forgotModal.classList.add("show");
    });

    contactModal.addEventListener("click", function(e) {
        if (e.target === contactModal) {
            contactModal.classList.remove("show");
            forgotModal.classList.add("show");
        }
    });
</script>
</body>
</html>

