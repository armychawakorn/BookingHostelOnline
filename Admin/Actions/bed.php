<?php
$bedid = $_GET['bedid'];
$action = $_GET['action'];
require_once('../../sql.php');
if ($action === 'delete') {
    $sql = "DELETE FROM bed WHERE BedID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bedid);
    $stmt->execute();
    header('Location: /BookingHostelOnline/Admin/Pages/room.php');
    exit();
} else if ($action === 'edit') {
    $sql = "SELECT * FROM bed WHERE BedID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bedid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}