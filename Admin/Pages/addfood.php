<?php
if (!isset($_SESSION['admin'])) {
    header('Location: /BookingHostelOnline/Admin');
    exit();
}
if (isset($_GET['error'])) {
    echo '<script>alert(' . $_GET['error'] . ')</script>';
}
require_once('../sql.php');
?>
<div>
    <h2>Add Food</h2>
    <hr>
    <div class="pb-2">
        <a href="/BookingHostelOnline/Admin/dashboard.php?page=foods" class="btn btn-primary">Back</a>
    </div>
    <form class="form" action="/BookingHostelOnline/Admin/dashboard.php?page=addfood" method="post">
        <div class="form-group">
            <label for="foodname">Food Name</label>
            <input type="text" class="form-control" id="foodname" name="foodname" required>
        </div>
        <div class="form-group">
            <label for="fooddescription">Food Description</label>
            <textarea class="form-control" id="fooddescription" name="fooddescription" required></textarea>
        </div>
        <div class="form-group">
            <label for="foodimage">Food Image</label>
            <input type="text" class="form-control" id="foodimage" name="foodimage" required>
        </div>
        <div class="form-group">
            <label for="foodprice">Food Price</label>
            <input type="number" class="form-control" id="foodprice" name="foodprice" required>
        </div>
        <div class="form-group"></div>
            <label for="foodstatus">Food Status</label>
            <select class="form-control" id="foodstatus" name="foodstatus" required>
                <option value="1">Available</option>
                <option value="0">Unavailable</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Food</button>
    </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foodname = $_POST['foodname'];
    $fooddescription = $_POST['fooddescription'];
    $foodimage = $_POST['foodimage'];
    $foodprice = $_POST['foodprice'];
    $foodstatus = $_POST['foodstatus'];
    $sql = "INSERT INTO food (FoodName, Description, Picture, Price, IsActive) VALUES ('$foodname', '$fooddescription', '$foodimage', '$foodprice', '$foodstatus')";
    if ($conn->query($sql) === TRUE) {
    } else {
        header('Location: /BookingHostelOnline/Admin/dashboard.php?page=addfood&error=' . $conn->error);
        exit();
    }
}
?>