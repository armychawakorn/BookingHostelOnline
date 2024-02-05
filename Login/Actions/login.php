<?php
$username = $_POST['username'];
$password = $_POST['password'];
require_once('../../sql.php');
$sql = "SELECT * FROM member WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['Password'])) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $row['FirstName'];
        $_SESSION['lastname'] = $row['LastName'];
        $_SESSION['email'] = $row['Email'];
        $_SESSION['mobile'] = $row['Mobile'];
        $_SESSION['isActive'] = $row['IsActive'];
        header('Location: ../../');
    } else {
        header('Location: ../../Login?error');
    }
} else {
    header('Location: ../../Login?error');
}
