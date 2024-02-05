<?php
if (!isset($_SESSION['admin'])) {
    header('Location: /BookingHostelOnline/Admin');
    exit();
}
require_once('../sql.php');
$sql = "SELECT * FROM bookingdetail";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<div>
    <h2>Booking Details</h2>
    <hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Booking Code</th>
            <th>Bed ID</th>
            <th>Check In Date</th>
            <th>Check Out Date</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td class="pt-4"><?php echo $row['BookingCode']; ?></td>
                <td class="pt-4"><?php echo $row['BedId']; ?></td>
                <td class="pt-4"><?php echo $row['CheckInDate']; ?></td>
                <td class="pt-4"><?php echo $row['CheckOutDate']; ?></td>
                <td><a href="/BookingHostelOnline/Admin/Actions/bookingdetail.php?bookingcode=<?php echo $row['BookingCode']; ?>&bedid=<?php echo $row['BedId']; ?>&checkindate=<?php echo $row['CheckInDate']; ?>&checkoutdate=<?php echo $row['CheckOutDate']; ?>" class="btn btn-danger">Checkout</a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</div>