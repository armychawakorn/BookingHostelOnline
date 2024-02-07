<?php
if (!isset($_SESSION['admin'])) {
    header('Location: /BookingHostelOnline/Admin/');
    exit();
}
require_once('../sql.php');
$sql = "SELECT * FROM member";
$result = $conn->query($sql);
?>
<div>
    <h2>Members</h2>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>CreateDate</th>
                <th>IsActive</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td class="pt-4"><?php echo $row['Username']; ?></td>
                        <td class="pt-4"><?php echo $row['FirstName']; ?></td>
                        <td class="pt-4"><?php echo $row['LastName']; ?></td>
                        <td class="pt-4"><?php echo $row['Email']; ?></td>
                        <td class="pt-4"><?php echo $row['Mobile']; ?></td>
                        <td class="pt-4"><?php echo $row['CreateDate']; ?></td>
                        <td class="pt-4"><?php echo ($row['IsActive'] == 1 ? 'Activate' : 'Deactivate') ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
