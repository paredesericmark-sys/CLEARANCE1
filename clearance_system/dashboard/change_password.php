<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$message = "";

if ($role === 'admin') {
    $stmt = $conn->prepare("SELECT * FROM admin WHERE id = ?");
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    die("User not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = md5($_POST['current_password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($current_password !== $user['password']) {
        $message = "Current password is incorrect.";
    } elseif ($new_password !== $confirm_password) {
        $message = "New password and confirm password do not match.";
    } else {
        $hashed_new_password = md5($new_password);

        if ($role === 'admin') {
            $update = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
        } else {
            $update = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        }

        $update->bind_param("si", $hashed_new_password, $user_id);

        if ($update->execute()) {
            $message = "Password changed successfully.";
        } else {
            $message = "Failed to change password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="student-wrapper">
    <div class="student-sidebar">
        <div class="student-profile">
            <div class="student-avatar">👤</div>
            <h3><?php echo htmlspecialchars($_SESSION['name']); ?></h3>
            <?php if ($role !== 'admin' && !empty($user['email'])): ?>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
            <?php endif; ?>
        </div>

        <?php if ($role === 'student'): ?>
            <a href="student.php" class="side-btn">Dashboard</a>
            <a href="student_result.php" class="side-btn">Result</a>
        <?php elseif ($role === 'teacher'): ?>
            <a href="teacher.php" class="side-btn">Dashboard</a>
        <?php elseif ($role === 'admin'): ?>
            <a href="admin.php" class="side-btn">Dashboard</a>
        <?php endif; ?>

        <a href="change_password.php" class="side-btn active">Change Password</a>
        <a href="../auth/logout.php" class="side-btn">Log Out</a>
    </div>

    <div class="student-main">
        <div class="student-header-top">SOUTHERN PHILIPPINES INSTITUTE OF SCIENCE AND TECHNOLOGY</div>
        <div class="student-header-bottom">CLEARANCE OF STUDENT’S</div>

        <div class="change-password-layout">
            <div class="change-password-form-box">
                <form method="POST">
                    <label>Current password<span class="required-star">*</span>:</label>
                    <input type="password" name="current_password" required>

                    <label>New password<span class="required-star">*</span>:</label>
                    <input type="password" name="new_password" required>

                    <label>Confirm password<span class="required-star">*</span>:</label>
                    <input type="password" name="confirm_password" required>

                    <button type="submit" class="change-submit-btn">Submit</button>

                    <?php if (!empty($message)): ?>
                        <p class="change-password-message"><?php echo htmlspecialchars($message); ?></p>
                    <?php endif; ?>
                </form>
            </div>

            <div class="change-password-info-box">
                <div class="change-profile-circle">👤</div>
                <div class="change-user-info">
                    <p><strong>NAME:</strong><br><?php echo htmlspecialchars($_SESSION['name']); ?></p>
                    <?php if (!empty($user['email'])): ?>
                        <p><strong>EMAIL:</strong><br><?php echo htmlspecialchars($user['email']); ?></p>
                    <?php endif; ?>
                    <?php if ($role !== 'admin' && !empty($user['contact_number'])): ?>
                        <p><strong>Contact:</strong><br><?php echo htmlspecialchars($user['contact_number']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>