<?php
include("../config/db.php");

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$name = $first_name . " " . $last_name;
$email = trim($_POST['email']);
$contact_number = trim($_POST['contact_number']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];

if ($password !== $confirm_password) {
    die("Password and Confirm Password do not match.");
}

$check = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($check->num_rows > 0) {
    die("Email already exists.");
}

$hashed_password = md5($password);

$sql = "INSERT INTO users (name, email, password, role)
        VALUES ('$name', '$email', '$hashed_password', '$role')";

if ($conn->query($sql)) {
    header("Location: login.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>