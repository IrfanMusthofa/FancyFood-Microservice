<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Menu</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
  >
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Latar belakang blur */
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

    /* Gaya umum button (serupa login.php) */
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

    /* Kartu menu */
    .menu-card {
      background-color: #f3f4f6; /* abu-abu muda (Tailwind: bg-gray-100) */
      border: 1px solid #b91c1c; /* Wine Red Border (Tailwind: red-700) */
      border-radius: 0.375rem;
      padding: 1rem;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .menu-card:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <!-- Latar belakang blur -->
  <div class="background"></div>

  <!-- Container utama -->
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl relative">
    <h1 class="text-2xl font-semibold text-center mb-6" style="color: #750028;">
      Our Menu
    </h1>

    <!-- Grid untuk menampilkan daftar menu -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($menus as $menu) : ?>
        <?php 
          // Format harga dengan pemisah ribuan, contoh: 15.000
          $priceFormatted = number_format($menu['menu_price'], 0, ',', '.');
        ?>
        <div class="menu-card">
          <h2 class="text-xl font-bold mb-2" style="color: #750028;">
            <?= htmlspecialchars($menu['menu_name']) ?>
          </h2>
          <p class="text-sm">
            Price: IDR <strong><?= htmlspecialchars($priceFormatted) ?></strong>
          </p>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Tombol kembali / navigasi lain -->
    <div class="flex justify-center mt-8">
      <a href="/sanchayataste/dashboard">
        <button class="py-2 px-6 rounded-lg bg-red-300">
          Back to Dashboard
        </button>
      </a>
    </div>
  </div>
</body>
</html>
