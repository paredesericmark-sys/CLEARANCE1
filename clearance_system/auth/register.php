<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="bg-page">

    <div class="overlay-box register-box">
        <a href="login.php" class="close-btn">✕</a>
        <h1 class="form-title">Create Account</h1>

        <form action="process_register.php" method="POST" class="register-form">
            <div class="form-grid">

                <div class="input-group">
                    <input type="text" name="firstname" placeholder=" " required>
                    <label>First Name:</label>
                </div>

                <div class="input-group">
                    <input type="text" name="lastname" placeholder=" " required>
                    <label>Last Name:</label>
                </div>

                <div class="input-group">
                    <input type="email" name="email" placeholder=" " required>
                    <label>Email:</label>
                </div>

                <div class="input-group">
                    <input type="text" name="contact_number" placeholder=" " required>
                    <label>Contact Number:</label>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="regPassword" placeholder=" " required>
                    <label>Password:</label>
                </div>

                <div class="input-group">
                    <select name="role" id="roleSelect" required onchange="toggleCourseField()">
                        <option value="">Select Role</option>
                        <option value="student">STUDENT</option>
                        <option value="teacher">TEACHER / OTHERS</option>
                    </select>
                    <label>Role:</label>
                </div>

                <div class="input-group">
                    <input type="password" name="confirm_password" id="confirmPassword" placeholder=" " required>
                    <label>Confirm Password:</label>
                </div>

                <div class="input-group" id="courseField" style="display: none;">
                    <select name="course" id="courseSelect">
                        <option value="">Course</option>
                        <option value="BSIT 1">BSIT 1</option>
                        <option value="BSIT 2">BSIT 2</option>
                        <option value="BSIT 3">BSIT 3</option>
                        <option value="BSIT 4">BSIT 4</option>
                    </select>
                    <label>Course:</label>
                </div>

            </div>

            <div class="btn-wrap">
                <button type="submit" class="green-btn">Sign Up</button>
            </div>
        </form>
    </div>

    <script src="../assets/script.js"></script>
</body>
</html>


