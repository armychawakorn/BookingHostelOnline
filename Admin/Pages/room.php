<?php
if (!isset($_SESSION['admin'])) {
    header('Location: /BookingHostelOnline/Admin');
    exit();
}
require_once('../sql.php');
//แสดงtableเพื่อจัดการห้องและเตียง สามารถเพิ่มและลบได้
$sql = "SELECT * FROM bed";
$result = $conn->query($sql);
?>
<div>
    <h2>Room</h2>
    <hr>
    <button class="btn btn-primary" onclick="window.location.href='/BookingHostelOnline/Admin/dashboard.php?page=addroom'">Add Bed</button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>BedID</th>
                <th>RoomName</th>
                <th>MaxGuest</th>
                <th>RoomType</th>
                <th>Price</th>
                <th>IsActivate</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td class="pt-4"><?php echo $row['BedID']; ?></td>
                    <td class="pt-4"><?php echo $row['RoomName']; ?></td>
                    <td class="pt-4"><?php echo $row['MaxGuest']; ?></td>
                    <td class="pt-4"><?php echo $row['RoomType']; ?></td>
                    <td class="pt-4"><?php echo $row['Price']; ?></td>
                    <td class="pt-4"><?php echo $row['IsActivate']; ?></td>
                    <td><a href="/BookingHostelOnline/Admin/Actions/bed.php?bedid=<?php echo $row['BedID']; ?>&action=edit" class="btn btn-info">Edit</a> <a href="/BookingHostelOnline/Admin/Actions/bed.php?bedid=<?php echo $row['BedID']; ?>&action=delete" class="btn btn-danger">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>