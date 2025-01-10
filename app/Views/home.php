<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hover-zoom:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
            background-color: rgba(255, 255, 255, 0.7);
        }
        .blur-overlay {
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            width: 10%;
            height: 200%;
            background: rgba(255, 255, 255, 1);
            filter: blur(30px);
            pointer-events: none;
            z-index: 10;
        }
    </style>
</head>
<body class="h-screen flex justify-center items-center">
    <div class="flex w-full h-full relative">
        <div class="blur-overlay"></div>
        <div class="blur-overlay bottom-16"></div>
        <div class="flex-1 relative">
            <img src="<?= base_url() ?>images/sanchaya1.png" alt="Sanchaya" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 flex flex-col justify-center items-center">
                <a href="/sanchayataste">
                    <h1 class="text-white text-4xl md:text-6xl bg-black/50 px-4 py-4 rounded-lg hover-zoom">Sanchaya Taste</h1>
                </a>
                <h2 class="text-white text-xl md:text-2xl bg-black/50 px-4 my-6 py-2 rounded-lg">by Irfan</h2>
            </div>
        </div>
        <div class="flex-1 relative">
            <img src="<?= base_url() ?>images/wijaya1.png" alt="Wijaya" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 flex flex-col justify-center items-center">
                <a href="/thewijaya">
                    <h1 class="text-white text-4xl md:text-6xl bg-black/50 px-4 py-4 rounded-lg hover-zoom">The Wijaya</h1>
                </a>
                <h2 class="text-white text-xl md:text-2xl bg-black/50 px-4 my-6 py-2 rounded-lg">by Mattheauw</h2>
            </div>
        </div>
    </div>
</body>
</html>
