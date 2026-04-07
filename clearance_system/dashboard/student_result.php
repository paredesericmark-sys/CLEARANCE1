<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT cr.id, cr.subject, cr.status, cr.result, cr.comment, cr.date_signed
    FROM class_requests cr
    WHERE cr.student_id = ? AND cr.status = 'Reviewed'
    ORDER BY cr.id DESC
");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$results = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="student-wrapper">
    <div class="student-sidebar">
        <div class="student-profile">
            <div class="student-avatar">👤</div>
            <h3><?php echo htmlspecialchars($_SESSION['name']); ?></h3>
        </div>

        <a href="student.php" class="side-btn">Dashboard</a>
        <a href="student_result.php" class="side-btn active">Result</a>
        <a href="../auth/logout.php" class="side-btn">Log Out</a>
    </div>

    <div class="student-main">
        <div class="student-header-top">SOUTHERN PHILIPPINES INSTITUTE OF SCIENCE AND TECHNOLOGY</div>
        <div class="student-header-bottom">CLEARANCE COLLEGE DEPARTMENT</div>

        <div class="student-result-box">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($results->num_rows > 0): ?>
                        <?php $num = 1; ?>
                        <?php while($row = $results->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $num++; ?></td>
                                <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                <td><?php echo !empty($row['date_signed']) ? htmlspecialchars($row['date_signed']) : '-'; ?></td>
                                <td>
                                    <?php
                                    $badgeClass = 'status-default';
                                    if ($row['result'] === 'Passed') {
                                        $badgeClass = 'status-passed';
                                    } elseif ($row['result'] === 'Failed') {
                                        $badgeClass = 'status-failed';
                                    } elseif ($row['result'] === 'Incomplete') {
                                        $badgeClass = 'status-incomplete';
                                    }
                                    ?>
                                    <span class="result-badge <?php echo $badgeClass; ?>">
                                        <?php echo htmlspecialchars($row['result']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($row['comment']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No result available yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>