<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: /BookingHostelOnline/Admin');
    exit();
}
require_once('../../sql.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['bookingcode']) && isset($_GET['bedid']) && isset($_GET['checkindate']) && isset($_GET['checkoutdate'])) {
        $sql = "DELETE FROM bookingdetail WHERE BookingCode = ? AND BedId = ? AND CheckInDate = ? AND CheckOutDate = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $_GET['bookingcode'], $_GET['bedid'], $_GET['checkindate'], $_GET['checkoutdate']);
        $stmt->execute();
        $sql = "UPDATE bed SET IsActivate = 1 WHERE BedID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_GET['bedid']);
        $stmt->execute();
        header('Location: /BookingHostelOnline/Admin/Pages/bookingdetails.php');
        exit();
    }
}
?>