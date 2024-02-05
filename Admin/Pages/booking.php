<?php
require_once('../sql.php');
if (!isset($_SESSION['admin'])) {
    header('Location: /BookingHostelOnline/Admin');
    exit();
}
$sql = "SELECT * FROM booking";
$result = $conn->query($sql);
?>
<div>
    <h2>Booking</h2>
    <hr>
    <table class='table table-striped'>
        <thead>
            <tr class="text-center">
                <th>Booking ID</th>
                <th>Booking Code</th>
                <th>Bed</th>
                <th>Member</th>
                <th>Booking Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
                <th>#</th>
            </tr>
        </thead>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='text-center'>";
                echo "<td>" . $row['Id'] . "</td>";
                echo "<td>" . $row['BookingCode'] . "</td>";
                echo "<td>" . $row['BedId'] . "</td>";
                echo "<td>" . $row['MemberId'] . "</td>";
                echo "<td>" . $row['BookingDate'] . "</td>";
                echo "<td>" . $row['CheckInDate'] . "</td>";
                echo "<td>" . $row['CheckOutDate'] . "</td>";
                echo ($row['BookingStatus'] == 0) ? "<td>Waiting</td>" : (($row['BookingStatus'] == 1) ? "<td>Accepted</td>" : "<td>Rejected</td>");
                echo $row['BookingStatus'] == 0 ? "<td><a href='/BookingHostelOnline/Admin/Actions/booking.php?bookingcode=" . $row['BookingCode'] . "&status=1' class='btn btn-success'>Accept</a> <a href='/BookingHostelOnline/Admin/Actions/booking.php?bookingcode=" . $row['BookingCode'] . "&status=2' class='btn btn-danger'>Reject</a></td>" : "<td></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>