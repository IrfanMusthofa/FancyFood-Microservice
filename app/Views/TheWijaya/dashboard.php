<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
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

        button {
            transition: transform 0.3s, background-color 0.3s, color 0.3s;
            background-color: #93c5fd;
            color: black;
        }

        button:hover {
            transform: scale(1.05);
            background-color: #1a3d7c;
            color: white;
        }

        .cta-button {
            transition: transform 0.3s, background-color 0.3s, color 0.3s;
            background-color: #f87171;
            color: white;
            font-weight: bold;
        }

        .cta-button:hover {
            transform: scale(1.1);
            background-color: #e11d48;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="background"></div>
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md text-center">
        <h1 class="text-2xl font-semibold text-navy-700 mb-6">Welcome to The Wijaya</h1>

        <div class="mb-4">
            <button onclick="location.href='/thewijaya/booking/viewbookingcustomer'" class="w-full py-2 bg-blue-300 rounded-lg mb-4">View Bookings</button>
            <button onclick="location.href='/thewijaya/room/viewroom'" class="w-full py-2 bg-blue-300 rounded-lg mb-4">View Rooms</button>
            <button onclick="location.href='/thewijaya/booking/selectbook'" class="w-full py-3 cta-button rounded-lg">Book your stay!</button>
            <button onclick="location.href='/thewijaya/special/'" class="w-full py-3 mt-4 cta-button rounded-lg">Special discount!</button>

        </div>

        <div class"m-8">
            <a href='/thewijaya/logout' class="py-4 hover:text-pink-700">Logout</a>
        </div>
    </div>
</body>
</html>
