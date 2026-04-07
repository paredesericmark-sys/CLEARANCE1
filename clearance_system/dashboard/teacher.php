<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit;
}

$teacher_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM teacher_classes WHERE teacher_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$classes = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="teacher-wrapper">
    <div class="teacher-sidebar">
        <div class="teacher-profile">
            <div class="teacher-avatar">👤</div>
            <h3><?php echo htmlspecialchars($_SESSION['name']); ?></h3>
        </div>

        <a href="teacher.php" class="side-btn active">Dashboard</a>
        <a href="class_board.php?class_id=<?php echo $class_id; ?>" class="side-btn">List of Request</a>
        <a href="change_password.php" class="side-btn">Change Password</a>
        <a href="../auth/logout.php" class="side-btn">Log Out</a>
    </div>

    <div class="teacher-main">
        <div class="teacher-header-top">SOUTHERN PHILIPPINES INSTITUTE OF SCIENCE AND TECHNOLOGY</div>
        <div class="teacher-header-bottom">CLEARANCE OF STUDENT’S</div>

        <div class="teacher-board-area">
            <?php while($row = $classes->fetch_assoc()): ?>
                <div class="class-card">
                    <h2><?php echo htmlspecialchars($row['course']); ?></h2>
                    <h4><?php echo htmlspecialchars($row['subject']); ?></h4>
                    <p><?php echo htmlspecialchars($_SESSION['name']); ?></p>
                    <a href="class_board.php?class_id=<?php echo $row['id']; ?>" class="join-btn">Join</a>
                </div>
            <?php endwhile; ?>

            <button class="add-class-btn" onclick="openClassModal()">+</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="classModal">
    <div class="class-modal-box">
        <h2>Create Class</h2>

        <form action="create_class.php" method="POST">
            <div class="class-form-group">
                <label>Subject</label>
                <input type="text" name="subject" required>
            </div>

            <div class="class-form-group">
                <label>Course</label>
                <select name="course" required>
                    <option value="">Select Course</option>
                    <option value="BSIT 1">BSIT 1</option>
                    <option value="BSIT 2">BSIT 2</option>
                    <option value="BSIT 3">BSIT 3</option>
                    <option value="BSIT 4">BSIT 4</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" class="cancel-btn" onclick="closeClassModal()">Cancel</button>
                <button type="submit" class="create-btn">Create</button>
            </div>
        </form>
    </div>
</div>

<script src="../assets/script.js"></script>
</body>
</html>



