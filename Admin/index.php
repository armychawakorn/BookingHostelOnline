<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <?php
        session_start();
        if(isset($_GET['error'])) {
            echo "<script>alert('".$_GET['error']."')</script>";
        }
        if(isset($_SESSION['admin'])){
            header('Location: /BookingHostelOnline/Admin/dashboard.php');
            exit();
        }
    ?>
    <?php require_once('./Components/Nav.php');?>
    <div class="container pt-4">
        <?php
        require_once('./lib/generatePassword.php');
        require_once('../sql.php');
        $sql = "SELECT * FROM systemuser";
        $result = $conn->query($sql);
        if ($result->num_rows < 1) {
            $password = generateRandomString(10);
            $sql = "INSERT INTO systemuser (Username, Password) VALUES ('admin', '" . password_hash($password, PASSWORD_DEFAULT) . "')";
            $conn->query($sql);
            echo "Username: admin<br>Password: " . $password;
            echo "<br>Copy this password and change it after login";
            echo "<br><a href='/BookingHostelOnline/Admin/'>Login</a>";
        } else {
            require_once('./Components/Login.php');
        }
        ?>
    </div>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>