<?php
require_once('../sql.php');
$foodid = $_GET['foodid'];
$action = $_GET['action'];
$sql = "SELECT * FROM food WHERE FoodID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $foodid);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($action === 'edit') {
        $foodname = $row['FoodName'];
        $description = $row['Description'];
        $price = $row['Price'];
        $isactivate = $row['IsActivate'];
    } else if ($action === 'delete') {
        $sql = "DELETE FROM food WHERE FoodID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $foodid);
        $stmt->execute();
        header('Location: /BookingHostelOnline/Admin/dashboard.php?page=managefood');
        exit();
    }
}
?>