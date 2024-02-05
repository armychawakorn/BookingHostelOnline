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
    <?php require_once('../../Components/Nav.php') ?>
    <div class="container">
        <?php
        require_once('../../sql.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $isActive = 1;
        $password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $sql = "INSERT INTO member (Username, Password, FirstName, LastName, Email, Mobile, IsActive) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $username, $password, $firstname, $lastname, $email, $mobile, $isActive);
            $stmt->execute();
            $stmt->close();
            echo "<h5>Register Success!</h5>";
            echo "<p>Register success you can login to booking our room! <a href='../../Login'>Login</a></p>";
        } catch (mysqli_sql_exception $e) {
            echo "<h5>Error: " . $e->getMessage() . "</h5>";
            echo "<a href='../'>Go back to register</a>";
        }
        ?>
    </div>
</body>

</html>