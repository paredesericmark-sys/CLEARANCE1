<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$courseFilter = isset($_GET['course']) ? trim($_GET['course']) : '';
$viewRole = isset($_GET['view']) ? trim($_GET['view']) : 'students';

$sql = "SELECT * FROM users WHERE 1=1";
$params = [];
$types = "";

if ($viewRole === 'students') {
    $sql .= " AND role = 'student'";
} elseif ($viewRole === 'teachers') {
    $sql .= " AND role = 'teacher'";
}

if (!empty($courseFilter) && $viewRole === 'students') {
    $sql .= " AND course = ?";
    $params[] = $courseFilter;
    $types .= "s";
}

if (!empty($search)) {
    $sql .= " AND (firstname LIKE ? OR lastname LIKE ? OR email LIKE ? OR contact_number LIKE ?)";
    $searchLike = "%" . $search . "%";
    $params[] = $searchLike;
    $params[] = $searchLike;
    $params[] = $searchLike;
    $params[] = $searchLike;
    $types .= "ssss";
}

$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$totalStudentsQuery = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='student'");
$totalStudents = $totalStudentsQuery->fetch_assoc()['total'];

$totalTeachersQuery = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='teacher'");
$totalTeachers = $totalTeachersQuery->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="admin-wrapper">
    <div class="sidebar">
        <div class="profile-box">
            <div class="profile-icon">👤</div>
            <h3>ADMIN</h3>
            <p><?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Administrator'; ?></p>
        </div>

        <div class="dropdown">
            <button type="button" class="side-btn dropdown-btn" onclick="toggleDropdown()">
                DASHBOARD ⬇
            </button>

            <div id="dropdownContent" class="dropdown-content">
                <a href="admin.php?view=students&course=BSIT%201">BSIT 1</a>
                <a href="admin.php?view=students&course=BSIT%202">BSIT 2</a>
                <a href="admin.php?view=students&course=BSIT%203">BSIT 3</a>
                <a href="admin.php?view=students&course=BSIT%204">BSIT 4</a>
            </div>
        </div>

        <a class="side-btn <?php echo ($viewRole === 'teachers') ? 'active' : ''; ?>" href="admin.php?view=teachers">List of Teacher</a>
        <a class="side-btn" href="#">Reports</a>
        <a class="side-btn" href="#">Change Password</a>
        <a class="side-btn" href="../auth/logout.php">Log Out</a>
    </div>

    <div class="main-content">
        <div class="top-header">SOUTHERN PHILIPPINES INSTITUTE OF SCIENCE AND TECHNOLOGY</div>
        <div class="sub-header">CLEARANCE COLLEGE DEPARTMENT</div>

        <div class="content-area">
            <div class="top-controls">
                <form method="GET" action="admin.php" class="search-form">
                    <input type="hidden" name="view" value="<?php echo htmlspecialchars($viewRole); ?>">
                    <?php if (!empty($courseFilter) && $viewRole === 'students'): ?>
                        <input type="hidden" name="course" value="<?php echo htmlspecialchars($courseFilter); ?>">
                    <?php endif; ?>
                    <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">Search</button>
                </form>

                <div class="totals-box">
                    <?php if ($viewRole === 'students'): ?>
                        Total of Student:
                        <div class="count">
                            <?php
                            if (!empty($courseFilter)) {
                                $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM users WHERE role='student' AND course=?");
                                $countStmt->bind_param("s", $courseFilter);
                                $countStmt->execute();
                                $countRes = $countStmt->get_result()->fetch_assoc();
                                echo $countRes['total'];
                            } else {
                                echo $totalStudents;
                            }
                            ?>
                        </div>
                    <?php else: ?>
                        Total of Teacher:
                        <div class="count"><?php echo $totalTeachers; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>LIST OF <?php echo ($viewRole === 'students') ? 'STUDENTS' : 'TEACHERS'; ?></th>
                            <th>EMAIL</th>
                            <th>CONTACT</th>
                            <th>PASSWORD</th>
                            <?php if ($viewRole === 'students'): ?>
                                <th>COURSE</th>
                            <?php endif; ?>
                            <th>ROLE</th>
                            <th>User Management</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php if ($result->num_rows > 0): ?>
        <?php $display_id = 1; ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $display_id; ?></td>
                <td><?php echo htmlspecialchars($row['lastname'] . ', ' . $row['firstname']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['contact_number']); ?></td>
                <td>********</td>
                <?php if ($viewRole === 'students'): ?>
                    <td><?php echo htmlspecialchars($row['course']); ?></td>
                <?php endif; ?>
                <td><?php echo strtoupper(htmlspecialchars($row['role'])); ?></td>
                <td>
                    <a href="view_user.php?id=<?php echo $row['id']; ?>" class="action-btn view-btn">VIEW</a>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="action-btn edit-btn">Edit</a>
                    <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Delete this user?')">Delete</a>
                </td>
            </tr>
            <?php $display_id++; ?>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="<?php echo ($viewRole === 'students') ? '8' : '7'; ?>">No records found.</td>
        </tr>
    <?php endif; ?>
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../assets/script.js"></script>
</body>
</html>


