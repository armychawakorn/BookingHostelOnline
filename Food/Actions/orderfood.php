<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: ../../Login');
        exit();
    }
    if (!isset($_GET['bookingcode']) || !isset($_GET['foodid'])) {
        header('Location: ../');
        exit();
    }
    $bookingcode = $_GET['bookingcode'];
    $foodid = $_GET['foodid'];
    require_once('../../sql.php');
    $sql = "INSERT INTO bookingmeal (BookingCode, FoodId, MemberId, Status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $status = 0;
    $stmt->bind_param("sssi", $bookingcode, $foodid, $_SESSION['username'], $status);
    try {
        $stmt->execute();
        $stmt->close();
        header('Location: ../../Food/selectfood.php?bookingcode='.$bookingcode);
    } catch (mysqli_sql_exception $e) {
        $stmt->close();
        header('Location: ../../Food/selectfood.php?foodid='.$bookingcode.'&error='.$e->getMessage());
    }
?>