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
    <?php require_once('../Components/Nav.php') ?>
    <?php
    if (!isset($_SESSION['username'])) {
        header('Location: /BookingHostelOnline/Login');
        exit();
    }
    if (!isset($_GET['bookingcode'])) {
        header('Location: /BookingHostelOnline/Booking');
        exit();
    }
    if(isset($_GET['error'])){
        echo "<script>alert('Error')</script>";
    }
    require_once('../sql.php');
    $bookingcode = $_GET['bookingcode'];
    ?>
    <div class="container p-4">
        <?php
        $sql = "SELECT * FROM bookingmeal as bm, food as f WHERE BookingCode = ? AND bm.FoodId = f.Id;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bookingcode);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<h3>รายการอาหารที่สั่ง (" . $result->num_rows . ")</h3>";
            echo "<table class='table table-striped'>
                <thead>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Food Name</th>
                        <th scope='col'>Price</th>
                        <th scope='col'>Status</th>
                    </tr>
                </thead>
                <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<th scope='row'>" . $row['Id'] . "</th>";
                echo "<td>" . $row['FoodName'] . "</td>";
                echo "<td>" . $row['Price'] . "</td>";
                echo "<td>" . ($row['Status'] == 0 ? "รอการยืนยัน" : ($row['Status'] == 1 ? 'ยืนยัน' : 'ปฏิเสธ')) . "</td>";
                echo "</tr>";
            }
            echo "</tbody>
            </table>";
        } else {
            echo "<h3>ไม่มีรายการอาหารที่สั่ง</h3>";
        }
        ?>
        <br><hr>
        <?php
        $sql = "SELECT * FROM food WHERE IsActive = 1";
        $result = $conn->query($sql);
        ?>
        <h3>รายการอาหารทั้งหมด (<?php echo $result->num_rows ?>)</h3>
        <?php
        if ($result->num_rows > 0) {
            echo "<div class='row'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-lg-3'>
                    <div class='card p-3' style='width: 18rem;'>
                        <img src='" . $row['Picture'] . "' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title
                            '>" . $row['FoodName'] . "</h5>
                            <p class='card-text'>" . $row['Description'] . "</p>
                            <p class='card-text'>Price: " . $row['Price'] . "</p>
                            <a href='./Actions/orderfood.php?bookingcode=" . $bookingcode . "&foodid=" . $row['Id'] . "' class='btn btn-primary'>Order</a>
                        </div>
                    </div>
                </div>";
            }
            echo "</div>";
        } else {
            echo "<center><h5>No Food</h5></center>";
        }
        ?>
    </div>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>