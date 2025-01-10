<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('<?= base_url('images/wijaya1.png') ?>') no-repeat center center/cover;
            filter: blur(8px);
            z-index: -1;
        }

        .room-card {
            background-color: rgba(243, 244, 246, 0.9); /* Reverted to original */
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 0.5rem;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .room-card:hover {
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
        <h1 class="text-2xl font-semibold text-navy-700 mb-6 text-center">Our Rooms</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            foreach ($rooms as $room):
                $isFullWidth = $room['room_number'] == 110;
                $priceFormatted = number_format($room['price_per_night'], 0, ',', '.'); // Format price with thousands separator
            ?>
                <div class="room-card <?= $isFullWidth ? 'full-width' : '' ?>">
                    <h2 class="text-xl font-bold text-navy-700">Room <?= htmlspecialchars($room['room_number']) ?></h2>
                    <p class="text-m text-bold text-pink-700">Type: <?= htmlspecialchars($room['room_type']) ?></p>
                    <p class="text-sm text-gray-700">Price: IDR <?= htmlspecialchars($priceFormatted) ?> / night</p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="flex justify-center mt-6">
            <a href="/thewijaya/dashboard" 
               class="bg-blue-500 text-white font-semibold py-2 px-6 rounded hover:bg-blue-600 transition duration-300">
                Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>
