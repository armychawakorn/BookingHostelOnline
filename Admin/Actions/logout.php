<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: /BookingHostelOnline/Admin');
    exit();
}
session_destroy();
header('Location: /BookingHostelOnline/Admin');
exit();