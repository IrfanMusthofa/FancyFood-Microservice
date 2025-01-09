<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Date</title>
</head>
<body>
    <form method="POST" action="/BookingController/selectRoom">
        <label>Check-in Date:</label>
        <input type="date" name="check_in_date" required>
        <label>Check-out Date:</label>
        <input type="date" name="check_out_date" required>
        <button type="submit">Next</button>
    </form>
</body>
</html>