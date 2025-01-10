<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order Now</title>
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
    .wine-red {
      background-color: rgba(115, 0, 40, 0.8); /* Wine Red */
      color: white;
    }
    .wine-red:hover {
      background-color: #750028; /* Darker Wine Red */
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
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md relative">
    <h1 class="text-2xl font-semibold text-center mb-6" style="color: #750028;">
      Order Now
    </h1>

    <!-- Tampilkan pesan sukses jika ada -->
    <?php if (session()->has('success')): ?>
      <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
        <?= session('success') ?>
      </div>
    <?php endif; ?>

    <!-- Tampilkan pesan error jika ada -->
    <?php if (session()->has('error')): ?>
      <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
        <?= session('error') ?>
      </div>
    <?php endif; ?>

    <form action="/sanchayataste/order/createorder" method="POST" id="orderForm">
      <!-- Pilih Menu -->
      <div class="mb-4">
        <label for="menu_id" class="block text-sm font-medium">Select Menu:</label>
        <select name="menu_id" id="menu_id" class="input-field" required>
          <option value="">-- Select Menu --</option>
          <?php foreach ($menus as $menu): ?>
            <option value="<?= $menu['id'] ?>" 
                    data-price="<?= $menu['menu_price'] ?>">
              <?= htmlspecialchars($menu['menu_name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Input Quantity -->
      <div class="mb-4">
        <label for="quantity" class="block text-sm font-medium">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="input-field" min="1" value="1" required />
      </div>

      <!-- Display Total Price (optional) -->
      <div class="mb-4">
        <label class="block text-sm font-medium">Total Price (IDR):</label>
        <div id="totalPriceDisplay" class="text-lg font-semibold mt-2">0</div>
      </div>

      <!-- Tombol Submit -->
      <button type="submit" 
              class="w-full py-2 mt-4 wine-red rounded-lg text-center">
        Order and Make a Payment
      </button>
    </form>

    <!-- Tambahkan tombol back ke dashboard -->
    <div class="flex justify-center mt-6">
      <a href="/sanchayataste/dashboard" 
         class="wine-red py-2 px-6 rounded hover:bg-red-800 transition duration-300 text-center">
        Back to Dashboard
      </a>
    </div>
  </div>

  <script>
    // Script untuk menghitung total price secara dinamis
    const menuSelect = document.getElementById('menu_id');
    const quantityInput = document.getElementById('quantity');
    const totalPriceDisplay = document.getElementById('totalPriceDisplay');

    function calculateTotalPrice() {
      const selectedOption = menuSelect.options[menuSelect.selectedIndex];
      const menuPrice = selectedOption.getAttribute('data-price') || 0;
      const quantity = quantityInput.value || 0;
      const total = parseInt(menuPrice) * parseInt(quantity);
      totalPriceDisplay.textContent = total.toLocaleString('id-ID');
    }

    // Event listener
    menuSelect.addEventListener('change', calculateTotalPrice);
    quantityInput.addEventListener('input', calculateTotalPrice);

    // Hitung pertama kali jika user sudah memilih data
    calculateTotalPrice();
  </script>
</body>
</html>
