<?php
    session_start();
    $login = isset($_SESSION['username']) ? '<div class="ps-3 pe-3"><a href="/BookingHostelOnline/Logout">Logout</a></div>' : '<div class="ps-3 pe-3"><a href="/BookingHostelOnline/Login">Login</a></div>';
    $register = isset($_SESSION['username']) ? 'Welcome ' . $_SESSION['username'] : '<div class="ps-3 pe-3"><a href="/BookingHostelOnline/Register">Register</a></div>';
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Toggle button -->
        <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
            <!-- Left links -->
            <div class="navbar-nav me-auto mb-2 mb-lg-0 pt-2">
                <img src="/BookingHostelOnline/Components/Images/logo.png" alt="" width="32" height="32" style="border-radius: 50%;"><h3>Loli Hostel</h3>
            </div>
            <!-- Left links -->

            <div class="d-flex align-items-center">
                <div class="ps-3 pe-3"><a href="/BookingHostelOnline/">Home</a></div>
                <div class="ps-3 pe-3"><a href="/BookingHostelOnline/About">About</a></div>
                <div class="ps-3 pe-3"><a href="/BookingHostelOnline/#booknow">Book Now</a></div>
                <div class="ps-3 pe-3"><a href="/BookingHostelOnline/Food">Food</a></div>
                <?php 
                    echo $register;
                    echo $login
                ?>
            </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->