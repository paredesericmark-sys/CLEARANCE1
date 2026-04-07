<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$student_course = isset($_SESSION['course']) ? trim($_SESSION['course']) : '';

$class_code = trim($_POST['class_code']);
$subject = trim($_POST['subject']);

if (empty($class_code) || empty($subject)) {
    die("Please complete all fields.");
}

$stmt = $conn->prepare("SELECT * FROM teacher_classes WHERE class_code = ?");
$stmt->bind_param("s", $class_code);
$stmt->execute();
$class = $stmt->get_result()->fetch_assoc();

if (!$class) {
    die("Invalid class code.");
}

if ($subject !== $class['subject']) {
    die("Subject does not match exactly.");
}

if ($student_course !== $class['course']) {
    die("Your course does not match this class.");
}

$class_id = $class['id'];

$check = $conn->prepare("SELECT id FROM class_requests WHERE class_id = ? AND student_id = ? AND subject = ?");
$check->bind_param("iis", $class_id, $student_id, $subject);
$check->execute();
$exists = $check->get_result();

if ($exists->num_rows > 0) {
    header("Location: student.php?success=1");
    exit;
}

$insert = $conn->prepare("
    INSERT INTO class_requests (class_id, student_id, subject, status, result, comment)
    VALUES (?, ?, ?, 'Requesting', '', '')
");
$insert->bind_param("iis", $class_id, $student_id, $subject);

if ($insert->execute()) {
    header("Location: student.php?success=1");
    exit;
} else {
    echo "Failed to submit request.";
}
?>