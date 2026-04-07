<?php
include("../config/db.php");

$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$email = trim($_POST['email']);
$contact_number = trim($_POST['contact_number']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];
$course = isset($_POST['course']) ? trim($_POST['course']) : null;

if ($password !== $confirm_password) {
    die("Password and Confirm Password do not match.");
}

if ($role !== 'student' && $role !== 'teacher') {
    die("Invalid role selected.");
}

if ($role === 'student' && empty($course)) {
    die("Please select a course for student.");
}

if ($role === 'teacher') {
    $course = null;
}

$checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
$result = $checkEmail->get_result();

if ($result->num_rows > 0) {
    die("Email already exists.");
}

$hashedPassword = md5($password);

$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, contact_number, password, role, course) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $firstname, $lastname, $email, $contact_number, $hashedPassword, $role, $course);

if ($stmt->execute()) {
    header("Location: login.php");
    exit;
} else {
    echo "Registration failed.";
}
?>