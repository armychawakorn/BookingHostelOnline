<?php
    session_start();
    $bedid = $_POST['bed'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $message = $_POST['message'];
    $bookingcode = uniqid() . uniqid();
    $username = $_SESSION['username'];
    require_once('../../sql.php');
    $sql = "INSERT INTO booking (BookingCode, BedId, MemberId, CheckInDate, CheckOutDate, BookingStatus, Message) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $status = 0;
    $stmt->bind_param("sssssis", $bookingcode, $bedid, $username, $checkin, $checkout, $status, $message);
    try {
        $stmt->execute();
        $stmt->close();
        $sql = "UPDATE bed SET IsActivate = 0 WHERE BedID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bedid);
        $stmt->execute();
        $stmt->close();
        header('Location: ../../Booking/bookingdetails.php?bookingcode='.$bookingcode);
    } catch (mysqli_sql_exception $e) {
        $stmt->close();
        header('Location: ../../Booking?error='.$e->getMessage());
    }
?>