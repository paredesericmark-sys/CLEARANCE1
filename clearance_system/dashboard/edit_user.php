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

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    die("User not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);
    $role = trim($_POST['role']);
    $new_password = trim($_POST['password']);

    $course = null;
    if ($role === 'student') {
        $course = isset($_POST['course']) ? trim($_POST['course']) : null;
    }

    if (!empty($new_password)) {
        $hashedPassword = md5($new_password);

        $update = $conn->prepare("UPDATE users SET firstname=?, lastname=?, email=?, contact_number=?, password=?, role=?, course=? WHERE id=?");
        $update->bind_param("sssssssi", $firstname, $lastname, $email, $contact_number, $hashedPassword, $role, $course, $id);
    } else {
        $update = $conn->prepare("UPDATE users SET firstname=?, lastname=?, email=?, contact_number=?, role=?, course=? WHERE id=?");
        $update->bind_param("ssssssi", $firstname, $lastname, $email, $contact_number, $role, $course, $id);
    }

    if ($update->execute()) {
        if ($role === 'teacher') {
            header("Location: admin.php?view=teachers");
        } else {
            header("Location: admin.php?view=students");
        }
        exit;
    } else {
        echo "Update failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="edit-modal-wrapper">
    <div class="edit-modal-box">

        <div class="edit-left-panel">
            <div class="edit-avatar-circle"></div>
        </div>

        <div class="edit-right-panel">
            <form method="POST" class="edit-user-form">

                <div class="edit-row">
                    <label>First name:</label>
                    <div class="edit-input-box">
                        <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                    </div>
                </div>

                <div class="edit-row">
                    <label>Last name:</label>
                    <div class="edit-input-box">
                        <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                    </div>
                </div>

                <div class="edit-row">
                    <label>Email:</label>
                    <div class="edit-input-box">
                        <input type="text" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                </div>

                <div class="edit-row">
                    <label>Contact Number:</label>
                    <div class="edit-input-box">
                        <input type="text" name="contact_number" value="<?php echo htmlspecialchars($user['contact_number']); ?>" required>
                    </div>
                </div>

                <div class="edit-row">
                    <label>Position/ Role:</label>
                    <div class="edit-input-box">
                        <input type="text" value="<?php echo ($user['role'] === 'teacher') ? 'Instructor' : strtoupper($user['role']); ?>" disabled>
                    </div>
                </div>

                <div class="edit-row">
                    <label>Password:</label>
                    <div class="edit-input-box">
                        <input type="text" name="password" placeholder="Enter new password">
                    </div>
                </div>

                <?php if ($user['role'] === 'student'): ?>
                <div class="edit-row">
                    <label>Course:</label>
                    <div class="edit-input-box">
                        <select name="course">
                            <option value="">Select Course</option>
                            <option value="BSIT 1" <?php echo ($user['course'] === 'BSIT 1') ? 'selected' : ''; ?>>BSIT 1</option>
                            <option value="BSIT 2" <?php echo ($user['course'] === 'BSIT 2') ? 'selected' : ''; ?>>BSIT 2</option>
                            <option value="BSIT 3" <?php echo ($user['course'] === 'BSIT 3') ? 'selected' : ''; ?>>BSIT 3</option>
                            <option value="BSIT 4" <?php echo ($user['course'] === 'BSIT 4') ? 'selected' : ''; ?>>BSIT 4</option>
                        </select>
                    </div>
                </div>
                <?php endif; ?>

                <input type="hidden" name="role" value="<?php echo htmlspecialchars($user['role']); ?>">

                <div class="edit-actions">
                    <a href="admin.php?view=<?php echo ($user['role'] === 'teacher') ? 'teachers' : 'students'; ?>" class="cancel-btn">Cancel</a>
                    <button type="submit" class="save-btn">Save changes</button>
                </div>

            </form>
        </div>

    </div>
</div>

</body>
</html>