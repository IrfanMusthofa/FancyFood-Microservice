<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
</head>
<body>
    <h3>Select a Room</h3>

    <form method="POST" action="/BookingController/paymentPage">
        <input type="hidden" name="check_in_date" value="<?= $checkInDate; ?>">
        <input type="hidden" name="check_out_date" value="<?= $checkOutDate; ?>">
        <?php foreach ($rooms as $room): ?>
            <div>
                <input type="radio" name="room_id" value="<?= $room['id']; ?>" required>
                <?= $room['room_name']; ?> - <?= $room['price_per_night']; ?>/night
            </div>
        <?php endforeach; ?>
        <button type="submit">Next</button>
    </form>
</body>
</html>