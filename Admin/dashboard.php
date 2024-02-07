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
    <?php
    session_start();
    if (isset($_GET['error'])) {
        echo "<script>alert('" . $_GET['error'] . "')</script>";
    }
    if (!isset($_SESSION['admin'])) {
        header('Location: /BookingHostelOnline/Admin');
        exit();
    }
    if (isset($_GET['page'])) $_SESSION['page'] = $_GET['page'];
    ?>
    <?php require_once('./Components/Nav.php') ?>
    <div class="container-flud g-0">
        <div class="row">
            <div class="col-lg-auto p-0">
                <?php require_once('./Components/sidebar.php'); ?>
            </div>
            <div class="col-lg p-0" style="overflow: scroll;">
                <div class="container-fluid pt-4">
                    <?php
                    if (isset($_GET['page'])) {
                        switch ($_GET['page']) {
                            case "booking":
                                require_once('./Pages/booking.php');
                                break;
                            case "bookingdetails":
                                require_once('./Pages/bookingdetails.php');
                                break;
                            case "bookingfood":
                                require_once('./Pages/bookingfood.php');
                                break;
                            case "room":
                                require_once('./Pages/room.php');
                                break;
                            case "members":
                                require_once('./Pages/members.php');
                                break;
                            case "foods":
                                require_once('./Pages/foods.php');
                                break;
                            case "addroom":
                                require_once('./Pages/addroom.php');
                                break;
                            case "addfood":
                                require_once('./Pages/addfood.php');
                                break;
                            default:
                                require_once('./Pages/booking.php');
                                break;
                        }
                    } else {
                        require_once('./Pages/booking.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>

</html>