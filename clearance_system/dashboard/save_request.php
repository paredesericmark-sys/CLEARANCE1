<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_POST['class_id'])) {
    die("Class ID missing.");
}

$class_id = intval($_POST['class_id']);

if (isset($_POST['result']) && is_array($_POST['result'])) {
    foreach ($_POST['result'] as $request_id => $result) {
        $request_id = intval($request_id);
        $result = trim($result);
        $comment = isset($_POST['comment'][$request_id]) ? trim($_POST['comment'][$request_id]) : '';

        $status = 'Requesting';
        $date_signed = null;

        if ($result === 'Passed' || $result === 'Failed' || $result === 'Incomplete') {
            $status = 'Reviewed';
            $date_signed = date('Y-m-d');
        }

        $stmt = $conn->prepare("
            UPDATE class_requests
            SET status = ?, result = ?, comment = ?, date_signed = ?
            WHERE id = ?
        ");
        $stmt->bind_param("ssssi", $status, $result, $comment, $date_signed, $request_id);
        $stmt->execute();
    }
}

header("Location: class_board.php?class_id=" . $class_id);
exit;
?>