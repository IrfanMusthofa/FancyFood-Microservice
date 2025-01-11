<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Discount View</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('<?= base_url('images/wijaya1.png') ?>') no-repeat center center / cover;
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
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl relative">
    <h1 class="text-2xl font-semibold text-center mb-4" style="color: #750028;">
      Special Discount
    </h1>

    <?php if (!empty($menusWithDiscount)): ?>
      <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse">
          <thead>
            <tr class="bg-gray-200 text-gray-700">
              <th class="py-2 px-4 border">No</th>
              <th class="py-2 px-4 border">Menu Name</th>
              <th class="py-2 px-4 border">Menu Price</th>
              <th class="py-2 px-4 border">Special Discount (%)</th>
              <th class="py-2 px-4 border">Discount Amount</th>
              <th class="py-2 px-4 border">Final Price</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($menusWithDiscount as $index => $item): ?>
              <?php
                $menuPrice      = number_format($item['menu_price'], 0, ',', '.');
                $discountAmount = number_format($item['discount_amount'], 0, ',', '.');
                $finalPrice     = number_format($item['final_price'], 0, ',', '.');
              ?>
              <tr class="text-center">
                <td class="py-2 px-4 border"><?= $index + 1 ?></td>
                <td class="py-2 px-4 border"><?= htmlspecialchars($item['menu_name']) ?></td>
                <td class="py-2 px-4 border">IDR <?= $menuPrice ?></td>
                <td class="py-2 px-4 border"><?= htmlspecialchars($item['special_discount']) ?>%</td>
                <td class="py-2 px-4 border text-blue-600 font-semibold">IDR <?= $discountAmount ?></td>
                <td class="py-2 px-4 border text-green-600 font-semibold">IDR <?= $finalPrice ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-center text-red-500">No discount data found.</p>
    <?php endif; ?>

    <div class="flex justify-center mt-6">
      <button onclick="location.href='/sanchayataste/dashboard'"
              class="w-full py-3 rounded-lg">
        Back to Dashboard
      </button>
    </div>
  </div>
</body>
</html>
