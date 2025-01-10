<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijaya Login Error</title>
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

        a {
            transition: color 0.3s, text-decoration 0.3s;
            color: #1a3d7c;
        }

        a:hover {
            color: #123060;
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="background"></div>
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md text-center">
        <h1 class="text-2xl font-semibold text-red-600 mb-6">Your Email or Password is incorrect, or You need to login first!</h1>
        <a href="/thewijaya" class="text-lg font-medium">Back to Login</a>
    </div>
</body>
</html>