<?php
session_start();
include("../config/db.php");

$email = trim($_POST['email']);
$password = md5($_POST['password']);

/* check fixed admin first */
$adminStmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
$adminStmt->bind_param("ss", $email, $password);
$adminStmt->execute();
$adminResult = $adminStmt->get_result();

if ($adminResult->num_rows > 0) {
    $admin = $adminResult->fetch_assoc();

    $_SESSION['user_id'] = $admin['id'];
    $_SESSION['name'] = $admin['name'];
    $_SESSION['role'] = 'admin';

    header("Location: ../dashboard/admin.php");
    exit;
}

/* check registered users */
$userStmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$userStmt->bind_param("ss", $email, $password);
$userStmt->execute();
$userResult = $userStmt->get_result();

if ($userResult->num_rows > 0) {
    $user = $userResult->fetch_assoc();

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['firstname'] . ' ' . $user['lastname'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['course'] = $user['course'];

    if ($user['role'] === 'student') {
        header("Location: ../dashboard/student.php");
        exit;
    }

    if ($user['role'] === 'teacher') {
        header("Location: ../dashboard/teacher.php");
        exit;
    }
}

echo "Invalid email or password.";
?>

