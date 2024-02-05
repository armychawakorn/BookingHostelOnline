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
            header('Location: /BookingHostelOnline/');
            exit();
        }
        require_once('../sql.php');
    ?>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="mb-4">Select Booking</h2>
                <form action="./selectfood.php" method="get">
                    <div class="form-group">
                        <label for="bookingcode">Booking Code</label>
                        <select class="form-control" id="bookingcode" name="bookingcode">
                            <?php
                            $sql = "SELECT * FROM bookingdetail as bd, booking as b WHERE b.MemberId = ? AND b.BookingCode = bd.BookingCode";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $_SESSION['username']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['BookingCode'] . "'>" . $row['BookingCode'] . "</option>";
                                }
                            }else{
                                echo "<option value=''>No Booking</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <?php echo $result->num_rows > 0 ? '<button type="submit" class="btn btn-primary">Select</button>' : "" ?>
                </form>
            </div>
        </div>
    </section>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>
</html>