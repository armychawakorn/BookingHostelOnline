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
    if (!isset($_GET['bookingcode'])) {
        header('Location: /BookingHostelOnline/');
        exit();
    }
    $bookingcode = $_GET['bookingcode'];
    require_once('../sql.php');
    $sql = "SELECT * FROM booking as bk, bed as b, member as m WHERE bk.BookingCode = ? AND b.BedID = bk.BedId AND m.Username = bk.MemberId;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bookingcode);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($result->num_rows == 0) {
        header('Location: /BookingHostelOnline/');
        exit();
    }
    ?>
    <section class="container">
        <div class="row justify-content-center p-3">
            <h2 class="mb-4">Booking Details</h2>
            <p>กรุณารอเจ้าหน้าที่ติดต่อกลับ เพื่อยืนยันการจองของคุณ</p>
            <div class="col-lg">
                <form>
                    <div class="form-group">
                        <label for="bookingcode">Booking Code</label>
                        <input type="text" class="form-control" id="bookingcode" name="bookingcode" value="<?php echo $row['BookingCode'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="member">Member</label>
                        <input type="text" class="form-control" id="member" name="member" value="<?php echo $row['FirstName'] . " " . $row['LastName'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $row['Mobile'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['Email'] ?>" readonly>
                    </div>
                    
                </form>
            </div>
            <div class="col-lg">
                <form>
                    <div class="form-group">
                        <label for="room">Room</label>
                        <input type="text" class="form-control" id="room" name="room" value="<?php echo "ห้อง " . $row['RoomName'] . ", หมายเลข " . $row['BedID'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="checkin">Check In</label>
                        <input type="text" class="form-control" id="checkin" name="checkin" value="<?php echo $row['CheckInDate'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="checkout">Check Out</label>
                        <input type="text" class="form-control" id="checkout" name="checkout" value="<?php echo $row['CheckOutDate'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" readonly><?php echo $row['Message'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?php echo $row['BookingStatus'] == 0 ? "Pending" : "Accept" ?>" readonly>
                    </div>
                </form>
            </div>
        </div>
    </section>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>
</html>