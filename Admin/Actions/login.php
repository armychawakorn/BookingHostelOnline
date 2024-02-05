<?php
require_once('../../sql.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM systemuser WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($_POST['password'], $row['Password'])) {
            session_start();
            $_SESSION['admin'] = $row['Username'];
            header('Location: /BookingHostelOnline/Admin/dashboard.php');
            exit();
        } else {
            header('Location: /BookingHostelOnline/Admin/?error=Invalid username or password');
            exit();
        }
    } else {
        header('Location: /BookingHostelOnline/Admin/?error=Invalid username or password');
        exit();
    }
}
?>