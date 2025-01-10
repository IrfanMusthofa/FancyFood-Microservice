<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Date</title>
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

        button {
            transition: transform 0.3s, background-color 0.3s, color 0.3s;
            background-color: rgba(10, 25, 60, 0.8);
            color: black;
        }

        button:hover {
            transform: scale(1.05);
            background-color: #1a3d7c;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="background"></div>
    <form method="POST" action="/thewijaya/booking/selectroom" class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-semibold text-navy-700 mb-6 text-center">Book your stay!</h1>

        <div class="mb-4">
            <label for="check_in_date" class="block text-sm font-medium text-navy-700">Check-in Date</label>
            <input type="date" id="check_in_date" name="check_in_date" required
                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-navy-500">
        </div>

        <div class="mb-6">
            <label for="check_out_date" class="block text-sm font-medium text-navy-700">Check-out Date</label>
            <input type="date" id="check_out_date" name="check_out_date" required
                class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-navy-500">
        </div>
        <div>
            <button type="submit" class="w-full bg-blue-300 text-black font-medium py-2 rounded-lg hover:bg-navy-600 focus:outline-none focus:ring-2 focus:ring-navy-500 focus:ring-offset-2">Find my room!</button>
        </div>
    </form>

    <script>
        const checkInDate = document.getElementById('check_in_date');
        const checkOutDate = document.getElementById('check_out_date');

        checkInDate.addEventListener('change', () => {
            const checkInValue = new Date(checkInDate.value);
            checkOutDate.min = new Date(checkInValue.getTime() + 86400000).toISOString().split('T')[0];
        });

        checkOutDate.addEventListener('change', () => {
            const checkOutValue = new Date(checkOutDate.value);
            checkInDate.max = new Date(checkOutValue.getTime() - 86400000).toISOString().split('T')[0];
        });
    </script>
</body>
</html>
