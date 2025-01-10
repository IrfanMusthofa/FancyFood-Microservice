<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Order List</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
  >
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url("<?= base_url('images/sanchaya1.png') ?>") no-repeat center center / cover;
      filter: blur(8px);
      z-index: -1;
    }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <!-- Background blur -->
  <div class="background"></div>

  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl relative">
    <h1 class="text-2xl font-semibold text-center mb-6" style="color: #750028;">
      Your Orders
    </h1>

    <!-- Tampilkan pesan sukses jika ada -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($orders)): ?>
      <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-700">
              <th class="py-2 px-4 border">No</th>
              <th class="py-2 px-4 border">Menu Name</th>
              <th class="py-2 px-4 border">Menu Price</th>
              <th class="py-2 px-4 border">Quantity</th>
              <th class="py-2 px-4 border">Total Price</th>
              <th class="py-2 px-4 border">Order Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $index => $order): ?>
              <?php
                // Format harga
                $menuPrice  = number_format($order['menu_price'], 0, ',', '.');
                $totalPrice = number_format($order['total_price'], 0, ',', '.');
              ?>
              <tr class="text-center">
                <td class="py-2 px-4 border"><?= $index + 1 ?></td>
                <td class="py-2 px-4 border"><?= htmlspecialchars($order['menu_name']) ?></td>
                <td class="py-2 px-4 border">IDR <?= $menuPrice ?></td>
                <td class="py-2 px-4 border"><?= htmlspecialchars($order['quantity']) ?></td>
                <td class="py-2 px-4 border">IDR <?= $totalPrice ?></td>
                <td class="py-2 px-4 border"><?= htmlspecialchars($order['order_date']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-center text-red-500">No orders found.</p>
    <?php endif; ?>

    <div class="flex justify-center mt-8">
      <a href="/sanchayataste/dashboard">
        <button 
          class="py-2 px-6 rounded-lg transition-transform bg-red-700 text-white hover:bg-red-800">
          Back to Dashboard
        </button>
      </a>
    </div>
  </div>
</body>
</html>
