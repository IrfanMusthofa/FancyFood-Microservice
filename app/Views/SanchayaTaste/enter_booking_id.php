<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Booking ID</title>
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
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="background"></div>
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-semibold text-center mb-4" style="color: #750028;">
            Enter Booking ID
        </h1>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (session()->has('error')): ?>
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                <?= session('error') ?>
            </div>
        <?php endif; ?>

        <form action="/sanchayataste/special/processbookingdiscount" method="POST">
            <div class="mb-6">
                <label for="booking_id" class="block mb-2 font-medium text-sm text-gray-700">
                    Booking ID:
                </label>
                <input 
                    type="number" 
                    id="booking_id" 
                    name="booking_id"
                    required 
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="e.g. 5"
                >
            </div>

            <button
                type="submit"
                class="w-full py-3 mt-4 bg-red-400 rounded-lg font-semibold"
            >
                Submit
            </button>
        </form>

        <div class="flex justify-center mt-6">
            <a href="/sanchayataste/dashboard" 
               class="bg-gray-400 text-white font-semibold py-2 px-6 rounded hover:bg-gray-500 transition duration-300">
                Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>
