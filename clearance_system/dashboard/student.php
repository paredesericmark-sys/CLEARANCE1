<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$student_name = $_SESSION['name'];

$stmt = $conn->prepare("
    SELECT cr.*, tc.subject as class_subject, tc.course as class_course, u.firstname, u.lastname
    FROM class_requests cr
    INNER JOIN teacher_classes tc ON cr.class_id = tc.id
    INNER JOIN users u ON tc.teacher_id = u.id
    WHERE cr.student_id = ?
    ORDER BY cr.id DESC
");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$cards = $stmt->get_result();

$show_success = isset($_GET['success']) && $_GET['success'] == '1';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="student-wrapper">
    <div class="student-sidebar">
        <div class="student-profile">
            <div class="student-avatar">👤</div>
            <h3><?php echo htmlspecialchars($student_name); ?></h3>
        </div>

        <a href="student.php" class="side-btn active">Dashboard</a>
        <a href="student_result.php" class="side-btn">Result</a>
        <a href="change_password.php" class="side-btn">Change Password</a>
        <a href="../auth/logout.php" class="side-btn">Log Out</a>
    </div>

    <div class="student-main">
        <div class="student-header-top">SOUTHERN PHILIPPINES INSTITUTE OF SCIENCE AND TECHNOLOGY</div>
        <div class="student-header-bottom">CLEARANCE COLLEGE DEPARTMENT</div>

        <div class="student-board-area">
            <?php if ($cards->num_rows > 0): ?>
                <?php while($row = $cards->fetch_assoc()): ?>
                    <div class="student-class-card <?php echo ($row['status'] !== 'Requesting') ? 'dim-card' : ''; ?>">
                        <h2><?php echo htmlspecialchars($row['class_subject']); ?></h2>
                        <p class="teacher-name">
                            <?php echo htmlspecialchars($row['lastname'] . ', ' . $row['firstname']); ?>
                        </p>
                        <p class="course-name"><?php echo htmlspecialchars($row['class_course']); ?></p>

                        <?php if ($row['status'] === 'Requesting'): ?>
                            <div class="student-request-note">
                                <span class="warning-icon">!</span>
                                Your request is waiting for approval.
                            </div>
                        <?php else: ?>
                            <div class="student-request-note done-note">
                                <span class="warning-icon">!</span>
                                Your request has been completed.
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

            <button class="student-add-btn" onclick="openRequestModal()">+</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="requestModal">
    <div class="student-request-modal">
        <h2>Clearance Request</h2>

        <form action="submit_request.php" method="POST">
            <div class="request-field">
                <label>Unit code:</label>
                <input type="text" name="class_code" required>
            </div>

            <div class="request-field">
                <label>Subject:</label>
                <input type="text" name="subject" required>
            </div>

            <div class="modal-actions">
                <button type="button" class="cancel-btn" onclick="closeRequestModal()">Cancel</button>
                <button type="submit" class="create-btn">Request</button>
            </div>
        </form>
    </div>
</div>

<?php if ($show_success): ?>
<div class="modal-overlay success-show" id="successModal" style="display:flex;">
    <div class="student-success-modal">
        <div class="success-icon">!</div>
        <p>Your clearance request has been successfully submitted.</p>
        <p>Please wait for approval from your instructor. You will be notified once your request has been reviewed.</p>
        <button type="button" class="ok-btn" onclick="closeSuccessModal()">OK</button>
    </div>
</div>
<?php endif; ?>

<script src="../assets/script.js"></script>
</body>
</html>


