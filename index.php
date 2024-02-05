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
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <?php require_once('./Components/Nav.php') ?>
    <div class="container-fluid g-0 background">
        <h1 style="color: red;">GET AN EXTRA 10% OFF DISCOUNT</h1>
    </div>
    <div class="container-fluid g-0 background2" id="booknow">
        <button type="button" class="btn btn-info btn-booking">
            BOOK NOW
        </button>
    </div>
    <script>
        document.querySelector('.btn-booking').addEventListener('click', function() {
            window.location.href = '/BookingHostelOnline/Booking';
        });
    </script>
</body>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

</html>