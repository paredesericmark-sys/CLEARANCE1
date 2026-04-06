<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="register-page">

    <div class="page-overlay"></div>

    <div class="register-container">
        <h1 class="register-title">Create Account</h1>

        <form action="process_register.php" method="POST" class="register-form">
            <div class="register-grid">
                <div class="field-group">
                    <label>First Name:</label>
                    <input type="text" name="first_name" required>
                </div>

                <div class="field-group">
                    <label>Last Name:</label>
                    <input type="text" name="last_name" required>
                </div>

                <div class="field-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>

                <div class="field-group">
                    <label>Contact Number:</label>
                    <input type="text" name="contact_number" required>
                </div>

                <div class="field-group full-left">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>

                <div class="field-group full-left">
                    <label>Confirm Password:</label>
                    <input type="password" name="confirm_password" required>
                </div>

                <div class="field-group full-left">
                    <label>Option:</label>
                    <select name="role" class="role-select" required>
                        <option value="">Select Option</option>
                        <option value="teacher">Teacher / Others</option>
                        <option value="student">Student</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="register-bottom">
                <a href="login.php" class="back-login">Back to Login</a>
                <button type="submit" class="register-btn">Sign Up</button>
            </div>
        </form>
    </div>

</body>
</html>