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
            background: url('<?= base_url('images/sanchaya1.png') ?>') no-repeat center center/cover;
            filter: blur(8px);
            z-index: -1;
        }

        button {
            transition: transform 0.3s, background-color 0.3s, color 0.3s;
            background-color: rgba(115, 0, 40, 0.8); /* Wine Red */
            color: black;
        }

        button:hover {
            transform: scale(1.05);
            background-color: #750028;
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
        <h1 class="text-2xl font-semibold text-navy-700 mb-6">Welcome to Sanchaya Taste</h1>

        <div class="mb-4">
            <button onclick="location.href='/sanchayataste/order/vieworder'" class="w-full py-2 bg-red-300 rounded-lg mb-4">View Order</button>
            <button onclick="location.href='/sanchayataste/menu/viewmenu'" class="w-full py-2 bg-red-300 rounded-lg mb-4">View Menu</button>
            <button onclick="location.href='/sanchayataste/order/select_menu'" class="w-full py-3 cta-button rounded-lg">Order Now!</button>
            <button onclick="location.href='/sanchayataste/special/enterbookingdiscount'" class="w-full py-3 cta-button bg-red-600 mt-6 rounded-lg">Special discount!</button>

        </div>

        <div class"m-8">
            <a href='/thewijaya/logout' class="py-4 hover:text-pink-700">Logout</a>
        </div>
    </div>
</body>
</html>
