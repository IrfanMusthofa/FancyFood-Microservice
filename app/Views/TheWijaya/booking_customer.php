<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/images/wijaya1.png') no-repeat center center/cover;
            filter: blur(8px);
            z-index: -1;
        }

        .booking-card {
            background-color: rgba(243, 244, 246, 0.9);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .booking-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .full-width {
            grid-column: span 3;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="background"></div>
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl">
        <h1 class="text-2xl font-semibold text-navy-700 mb-6 text-center">Your Bookings</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (empty($bookings)): ?>
                <p class="text-center text-gray-700 col-span-full">You haven't booked anything yet!</p>
            <?php else: ?>
                <?php foreach ($bookings as $booking): ?>
                    <div class="booking-card">
                        <h2 class="text-xl font-bold text-navy-700">Room ID: <?= htmlspecialchars($booking['room_id']) ?></h2>
                        <p class="text-m text-bold text-pink-700">Check-in: <?= htmlspecialchars($booking['check_in_date']) ?></p>
                        <p class="text-m text-bold text-pink-700">Check-out: <?= htmlspecialchars($booking['check_out_date']) ?></p>
                        <p class="text-sm text-gray-700">Total Price: IDR <?= number_format($booking['total_price'], 0, ',', '.') ?></p>
                        <p class="text-sm <?= $booking['paid'] ? 'text-green-500' : 'text-red-500' ?>">
                            Status: <?= $booking['paid'] ? 'Paid' : 'Unpaid' ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
