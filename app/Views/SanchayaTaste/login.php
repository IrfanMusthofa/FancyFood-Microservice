<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijaya Login</title>
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
            color: white;
        }

        button:hover {
            transform: scale(1.05);
            background-color: #750028; /* Darker Wine Red */
            color: white;
        }

        .input-field {
            background-color: #f3f4f6;
            border: 1px solid #b91c1c; /* Wine Red Border */
            border-radius: 0.375rem;
            padding: 0.5rem;
            width: 100%;
            margin-top: 0.5rem;
            outline: none;
            transition: box-shadow 0.3s;
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.5); /* Wine Red Shadow */
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="background"></div>
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-semibold text-navy-700 mb-6 text-center">Login to Sanchaya Taste</h1>
        <form action="/sanchaya/login" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-red-900" for="customer_email">Email:</label>
                <input id="customer_email" class="input-field" type="email" name="customer_email" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-red-900" for="password">Password:</label>
                <input id="password" class="input-field" type="password" name="password" required>
            </div>

            <button type="submit" class="w-full py-2 bg-red-300 rounded-lg">Login</button>
        </form>
    </div>
</body>
</html>
