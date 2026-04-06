<?php session_start(); ?>
<h1>Welcome Student: <?php echo $_SESSION['name']; ?></h1>

<a href="../clearance/request.php">Request Clearance</a>
<a href="../clearance/status.php">View Status</a>
<a href="../auth/logout.php">Logout</a>