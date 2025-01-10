<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>

  <!-- Font Poppins -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
  >

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* Contoh implementasi snippet background sesuai permintaan */

    /* Jika ingin memakai filter blur, aktifkan di bawah ini */
    /* filter: blur(8px); */

    .background-sanchaya {
      position: absolute;
      inset: 0; /* set top, right, bottom, left = 0 */
      background: url("<?= base_url('images/sanchaya1.png') ?>") no-repeat center center / cover;
      /* filter: blur(8px);    <-- aktifkan jika ingin blur */
      z-index: -1;
    }

    .background-wijaya {
      position: absolute;
      inset: 0;
      background: url("<?= base_url('images/wijaya1.png') ?>") no-repeat center center / cover;
      /* filter: blur(8px); */
      z-index: -1;
    }

    /* Hover zoom */
    .hover-zoom:hover {
      transform: scale(1.05);
      transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
      background-color: rgba(255, 255, 255, 0.7);
    }

    /* Efek blur overlay putih panjang di tengah layar */
    .blur-overlay {
      position: fixed;
      left: 50%;
      transform: translateX(-50%);
      width: 10%;
      height: 200%;
      background: rgba(255, 255, 255, 1);
      filter: blur(30px);
      filter: fixed; 
      pointer-events: none;
      z-index: 10;
    }
  </style>
</head>
<body class="h-screen flex justify-center items-center">
  <div class="flex w-full h-full relative">
    <!-- Overlay blur -->
    <div class="blur-overlay"></div>
    <div class="blur-overlay bottom-16"></div>

    <!-- Bagian kiri (Sanchaya) -->
    <div class="flex-1 relative">
      <!-- Gantikan <img> dengan div background -->
      <div class="background-sanchaya"></div>

      <!-- Konten teks dan tombol -->
      <div class="absolute inset-0 flex flex-col justify-center items-center">
        <a href="/sanchayataste">
          <h1 class="text-white text-4xl md:text-6xl bg-black/50 px-4 py-4 rounded-lg hover-zoom">
            Sanchaya Taste
          </h1>
        </a>
        <h2 class="text-white text-xl md:text-2xl bg-black/50 px-4 my-6 py-2 rounded-lg">
          by Irfan
        </h2>
      </div>
    </div>

    <!-- Bagian kanan (Wijaya) -->
    <div class="flex-1 relative">
      <!-- Gantikan <img> dengan div background -->
      <div class="background-wijaya"></div>

      <!-- Konten teks dan tombol -->
      <div class="absolute inset-0 flex flex-col justify-center items-center">
        <a href="/thewijaya">
          <h1 class="text-white text-4xl md:text-6xl bg-black/50 px-4 py-4 rounded-lg hover-zoom">
            The Wijaya
          </h1>
        </a>
        <h2 class="text-white text-xl md:text-2xl bg-black/50 px-4 my-6 py-2 rounded-lg">
          by Mattheauw
        </h2>
      </div>
    </div>
  </div>
</body>
</html>
