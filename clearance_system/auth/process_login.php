<?php
session_start();
include("../config/db.php");

$email = $_POST['email'];
$password = md5($_POST['password']);

$q = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
$user = $q->fetch_assoc();

if($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['name'] = $user['name'];

    if($user['role'] == 'admin'){
        header("Location: ../dashboard/admin.php");
    } elseif($user['role'] == 'teacher'){
        header("Location: ../dashboard/teacher.php");
    } else {
        header("Location: ../dashboard/student.php");
    }

} else {
    echo "Login Failed";
}