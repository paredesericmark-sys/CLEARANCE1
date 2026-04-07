<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("User ID not found.");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    die("User not found.");
}

$fullName = $user['lastname'] . ', ' . $user['firstname'];

if ($user['role'] === 'teacher') {
    $positionRole = "Instructor";
} else {
    $positionRole = strtoupper($user['role']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="info-page-wrapper">
    <div class="info-box">
        <div class="info-top">
            <h1>Information</h1>
            <a href="admin.php?view=<?php echo ($user['role'] === 'teacher') ? 'teachers' : 'students'; ?>" class="info-back-btn">Back</a>
        </div>

        <div class="info-content">
            <div class="info-row">
                <label>Full Name:</label>
                <div class="info-value"><?php echo htmlspecialchars($fullName); ?></div>
            </div>

            <div class="info-row">
                <label>Email :</label>
                <div class="info-value"><?php echo htmlspecialchars($user['email']); ?></div>
            </div>

            <div class="info-row">
                <label>Contact Number:</label>
                <div class="info-value"><?php echo htmlspecialchars($user['contact_number']); ?></div>
            </div>

            <div class="info-row">
                <label>Position/Role:</label>
                <div class="info-value"><?php echo htmlspecialchars($positionRole); ?></div>
            </div>

            <div class="info-row">
                <label>Password:</label>
                <div class="info-value">********</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>