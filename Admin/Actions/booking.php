<?php
    require_once('./checkpermission.php');
    $bookingcode = $_GET['bookingcode'];
    $status = $_GET['status'];
    require_once('../../sql.php');
    $sql = "UPDATE booking SET BookingStatus = ? WHERE BookingCode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $status, $bookingcode);
    $stmt->execute();
    $sql1 = "SELECT * FROM booking WHERE BookingCode = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("s", $bookingcode);
    $stmt1->execute();
    $result = $stmt1->get_result();
    $row = $result->fetch_assoc();
    if ($status == 1) {
        $sql = "INSERT INTO bookingdetail(BookingCode, BedId, CheckInDate, CheckOutDate) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $row['BookingCode'], $row['BedId'], $row['CheckInDate'], $row['CheckOutDate']);
        $stmt->execute();
    }
    header('Location: /BookingHostelOnline/Admin/dashboard.php?page=booking');
    exit();
?>