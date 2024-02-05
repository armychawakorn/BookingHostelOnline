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
    <h2>Add Room/bed</h2>
    <hr>
    <div class="pb-2">
        <a href="/BookingHostelOnline/Admin/dashboard.php?page=room" class="btn btn-primary">Back</a>
    </div>
    <form class="form" action="/BookingHostelOnline/Admin/dashboard.php?page=addroom" method="post">
        <div class="form-group">
            <label for="bedid">Bed Id</label>
            <input type="text" class="form-control" id="bedid" name="bedid" required>
        </div>
        <div class="form-group">
            <label for="bedid">Max guest</label>
            <input type="text" class="form-control" id="maxguest" name="maxguest" required>
        </div>
        <div class="form-group">
            <label for="roomname">Room Name</label>
            <input type="text" class="form-control" id="roomname" name="roomname" required>
        </div>
        <div class="form-group">
            <label for="roomimage">Room Image</label>
            <input type="text" class="form-control" id="roomimage" name="roomimage" required>
        </div>
        <div class="form-group">
            <label for="bedtype">Bed Type</label>
            <select class="form-control" id="bedtype" name="bedtype" required>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Triple">Triple</option>
                <option value="Quad">Quad</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bedprice">Bed Price</label>
            <input type="number" class="form-control" id="bedprice" name="bedprice" required>
        </div>
        <div class="form-group">
            <label for="bedstatus">Bed Status</label>
            <select class="form-control" id="bedstatus" name="bedstatus" required>
                <option value="1">Available</option>
                <option value="0">Unavailable</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Room</button>
    </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bedid = $_POST['bedid'];
    $maxguest = $_POST['maxguest'];
    $roomname = $_POST['roomname'];
    $roomimage = $_POST['roomimage'];
    $bedtype = $_POST['bedtype'];
    $bedprice = $_POST['bedprice'];
    $bedstatus = $_POST['bedstatus'];
    $sql = "INSERT INTO bed (BedID, RoomName, MaxGuest, RoomType, Picture, Price, IsActivate) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $bedid, $roomname, $maxguest, $bedtype, $roomimage, $bedprice, $bedstatus);
    try {
        $stmt->execute();
    } catch (Exception $e) {
        header('Location: /BookingHostelOnline/Admin/dashboard.php?page=addroom&error=' . $e->getMessage());
        exit();
    }
}
?>