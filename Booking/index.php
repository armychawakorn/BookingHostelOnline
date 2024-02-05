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
        if (isset($_GET['error'])) {
            echo "<script>alert('".$_GET['error']."')</script>";
        }
        require_once('../sql.php');
        $sql = "SELECT * FROM booking WHERE MemberId = ? AND BookingStatus = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            header('Location: /BookingHostelOnline/Booking/bookingdetails.php?bookingcode='.$result->fetch_assoc()['BookingCode']);
            exit();
        }
    ?>
    <div class="container">
        <div class="row pt-3">
            <div class="col-lg">
                <img src="./images/Screenshot 2024-02-04 163405.png" alt="" srcset="">
            </div>
            <div class="col-lg">
                <h2 class="mb-4">Booking</h2>
                <form action="./Actions/booking.php" method="post">
                    <div class="form-group">
                        <label for="room">Room</label>
                        <select class="form-control" id="bed" name="bed">
                            <?php
                            require_once('../sql.php');
                            $sql = "SELECT * FROM bed WHERE IsActivate = 1";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['BedID'] . "'>" . "เตียง" . $row['BedID'] . " | ห้อง " . $row['RoomName'] . "(" . $row['RoomType'] . ")" . " | ราคา " . $row['Price'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="checkin">Check In</label>
                        <input type="date" class="form-control" id="checkin" name="checkin">
                    </div>
                    <div class="form-group">
                        <label for="checkout">Check Out</label>
                        <input type="date" class="form-control" id="checkout" name="checkout">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" placeholder="ข้อความถึงพนักงาน"></textarea>
                    </div>
                    <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone-vibrate-fill" viewBox="0 0 16 16">
                            <path d="M4 4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm5 7a1 1 0 1 0-2 0 1 1 0 0 0 2 0M1.807 4.734a.5.5 0 1 0-.884-.468A8 8 0 0 0 0 8c0 1.347.334 2.618.923 3.734a.5.5 0 1 0 .884-.468A7 7 0 0 1 1 8c0-1.18.292-2.292.807-3.266m13.27-.468a.5.5 0 0 0-.884.468C14.708 5.708 15 6.819 15 8c0 1.18-.292 2.292-.807 3.266a.5.5 0 0 0 .884.468A8 8 0 0 0 16 8a8 8 0 0 0-.923-3.734M3.34 6.182a.5.5 0 1 0-.93-.364A6 6 0 0 0 2 8c0 .769.145 1.505.41 2.182a.5.5 0 1 0 .93-.364A5 5 0 0 1 3 8c0-.642.12-1.255.34-1.818m10.25-.364a.5.5 0 0 0-.93.364c.22.563.34 1.176.34 1.818s-.12 1.255-.34 1.818a.5.5 0 0 0 .93.364C13.856 9.505 14 8.769 14 8s-.145-1.505-.41-2.182" />
                        </svg> ทางทีมงานจะติดต่อคุณภายใน 6 ชั่วโมง เพื่อทำการยืนยันสถานะการจองและวางเงินมัดจำ</p>
                    <button type="submit" class="btn btn-primary">Booking</button>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

</html>