<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Special Discount Result</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
  >
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl relative">
    <h1 class="text-2xl font-semibold text-center mb-4" style="color: #750028;">
      Special Discount
    </h1>
    <p class="text-center mb-6 text-gray-600">
      Booking ID: <?= htmlspecialchars($bookingId) ?>, 
      Room ID: <?= htmlspecialchars($roomId) ?>
    </p>

    <?php if (!empty($specialDiscounts)): ?>
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
            <?php foreach ($specialDiscounts as $index => $item): ?>
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
                <td class="py-2 px-4 border">IDR <?= $discountAmount ?></td>
                <td class="py-2 px-4 border text-green-600 font-semibold">IDR <?= $finalPrice ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-center text-red-500">No special discount found.</p>
    <?php endif; ?>

    <div class="flex justify-center mt-6">
      <a href="/sanchayataste/dashboard" 
         class="bg-red-300 hover:bg-red-800 text-white font-semibold py-2 px-6 rounded">
        Back to Dashboard
      </a>
    </div>
  </div>
</body>
</html>
