<?php
if (!isset($_SESSION['admin'])) {
    header('Location: /BookingHostelOnline/Admin');
    exit();
}
require_once('../sql.php');
$sql = "SELECT bm.*, f.Id AS FoodId, f.FoodName FROM bookingmeal as bm, member as m, food as f 
WHERE bm.MemberId = m.Username AND bm.FoodId = f.Id";
$result = $conn->query($sql);
?>
<div>
    <h2>Booking Food</h2>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Booking Code</th>
                <th>Food</th>
                <th>MemberId</th>
                <th>Status</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td class="pt-4"><?php echo $row['Id']; ?></td>
                        <td class="pt-4"><?php echo $row['BookingCode']; ?></td>
                        <td class="pt-4"><?php echo $row['FoodName'] . " [ID" . $row['FoodId'] . "]"; ?></td>
                        <td class="pt-4"><?php echo $row['MemberId']; ?></td>
                        <td class="pt-4"><?php echo ($row['Status'] == 0) ? "Waiting</td>" : (($row['Status'] == 1) ? "Accepted</td>" : "Rejected") ?></td>
                        <?php echo $row['Status'] == 0 ? "<td><a href='/BookingHostelOnline/Admin/Actions/bookingmeal.php?id=" . $row['Id'] . "&status=1' class='btn btn-success'>Accept</a> <a href='/BookingHostelOnline/Admin/Actions/bookingmeal.php?id=" . $row['Id'] . "&status=2' class='btn btn-danger'>Reject</a></td>" : "<td></td>"; ?>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>