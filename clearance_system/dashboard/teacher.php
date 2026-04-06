<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SESSION['role'] != 'teacher') {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

    <div class="dashboard-container">
        <h1>Teacher Panel</h1>
        <p>Welcome, <?php echo $_SESSION['name']; ?></p>

        <a href="../clearance/approve.php">Approve Clearances</a>
        <a href="../auth/logout.php">Logout</a>
    </div>

</body>
</html>

