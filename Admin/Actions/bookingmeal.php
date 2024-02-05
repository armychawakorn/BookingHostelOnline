<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: /BookingHostelOnline/Admin');
    exit();
}
require_once('../../sql.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['id']) && isset($_GET['status'])){
        $sql = "UPDATE bookingmeal SET Status = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $_GET['status'], $_GET['id']);
        $stmt->execute();
        header('Location: /BookingHostelOnline/Admin/dashboard.php?page=bookingfood');
        exit();
    }
}
?>