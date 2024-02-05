<style>
    #sidebar {
        width: 250px;
        height: 100vh;
        background-color: #343a40;
        color: #fff;
        transition: all 0.3s;
    }

    #sidebar .sidebar-header {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #4f5962;
    }

    #sidebar ul p {
        color: #fff;
        padding: 10px;
    }

    #sidebar ul li a {
        padding: 10px 10px 10px 30px;
        font-size: 1.1em;
        display: block;
        color: #d1d2d4;
    }

    #sidebar ul li a:hover {
        color: #fff;
        background: #4f5962;
    }

    #sidebar.active {
        margin-left: -250px;
    }
</style>
<?php
    if(!isset($_GET['page'])) $_SESSION['page'] = 'booking';
?>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Dashboard</h3>
    </div>
    <ul class="list-unstyled components">
        <li <?php echo $_SESSION['page'] == 'booking' ? 'style="background-color: #4f5962;"' : ''?>>
            <a href="/BookingHostelOnline/Admin/dashboard.php?page=booking">Booking</a>
        </li>
        <li <?php echo $_SESSION['page'] == 'bookingdetails' ? 'style="background-color: #4f5962;"' : ''?>>
            <a href="/BookingHostelOnline/Admin/dashboard.php?page=bookingdetails">Booking Details</a>
        </li>
        <li <?php echo $_SESSION['page'] == 'bookingfood' ? 'style="background-color: #4f5962;"' : ''?>>
            <a href="/BookingHostelOnline/Admin/dashboard.php?page=bookingfood">Booking Food</a>
        </li>
        <li <?php echo $_SESSION['page'] == 'room' ? 'style="background-color: #4f5962;"' : ''?>>
            <a href="/BookingHostelOnline/Admin/dashboard.php?page=room">Room</a>
        </li>
        <li <?php echo $_SESSION['page'] == 'members' ? 'style="background-color: #4f5962;"' : ''?>>
            <a href="/BookingHostelOnline/Admin/dashboard.php?page=members">Members</a>
        </li>
        <li <?php echo $_SESSION['page'] == 'Foods' ? 'style="background-color: #4f5962;"' : ''?>>
            <a href="/BookingHostelOnline/Admin/dashboard.php?page=foods">Foods</a>
        </li>
        <li>
            <a href="/BookingHostelOnline/Admin/Actions/logout.php">Logout</a>
        </li>
    </ul>
</nav>