<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
</head>
<body>
    <h3>Booking History</h3>
    <?php foreach ($bookings as $booking): ?>
        <div>
            Room: <?= $booking['room_type']; ?><br>
            Check-in: <?= $booking['check_in_date']; ?><br>
            Check-out: <?= $booking['check_out_date']; ?><br>
            Total Price: <?= $booking['total_price']; ?><br>
        </div>
    <?php endforeach; ?>
</body>
</html>