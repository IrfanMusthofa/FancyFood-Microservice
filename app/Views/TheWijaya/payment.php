<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h3>Payment</h3>
    <form method="POST" action="/BookingController/processPayment">
        <input type="hidden" name="room_id" value="<?= $roomId; ?>">
        <input type="hidden" name="total_price" value="<?= $totalPrice; ?>">
        <label>Payment Method:</label>
        <select name="payment_method" required>
            <option value="QRIS">QRIS</option>
            <option value="Gopay">Gopay</option>
            <option value="Debit">Debit</option>
        </select>
        <button type="submit">Pay</button>
    </form>
</body>
</html>