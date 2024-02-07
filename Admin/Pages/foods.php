<?php
if (!isset($_SESSION['username'])) {
    header('Location: ../../Login');
    exit();
}
?>
<div>
    <h2>Manage Food</h2>
    <hr>
    <button class="btn btn-primary" onclick="window.location.href='/BookingHostelOnline/Admin/dashboard.php?page=addfood'">Add Food</button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>FoodID</th>
                <th>FoodName</th>
                <th>Description</th>
                <th>Image</th>
                <th>Price</th>
                <th>IsActivate</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once('../sql.php');
            $sql = "SELECT * FROM food";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td class="pt-4"><?php echo $row['Id']; ?></td>
                    <td class="pt-4"><?php echo $row['FoodName']; ?></td>
                    <td class="pt-4"><textarea name="" id="" cols="30" rows="4" readonly><?php echo $row['Description']; ?></textarea></td>
                    <td><img src="<?php echo $row['Picture']; ?>" alt="<?php echo $row['FoodName']; ?>" width="100" height="100"></td>
                    <td class="pt-4"><?php echo $row['Price']; ?></td>
                    <td class="pt-4"><?php echo $row['IsActive']; ?></td>
                    <td><a href="/BookingHostelOnline/Admin/Actions/managefood.php?foodid=<?php echo $row['Id']; ?>&action=edit" class="btn btn-info">Edit</a> <a href="/BookingHostelOnline/Admin/Actions/managefood.php?foodid=<?php echo $row['Id']; ?>&action=delete" class="btn btn-danger">Delete</a></td>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>