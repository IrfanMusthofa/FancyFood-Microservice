<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Book Your Stay</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet"
  />
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

    button {
      transition: transform 0.3s, background-color 0.3s, color 0.3s;
      background-color: rgba(10, 25, 60, 0.8);
      color: black;
    }

    button:hover {
      transform: scale(1.05);
      background-color: #1a3d7c;
      color: white;
    }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="background"></div>
  <!-- 
    Form diarahkan ke method goToPayment di BookingController 
    -> /thewijaya/booking/gotopayment
  -->
  <form
    method="POST"
    action="/thewijaya/booking/gotopayment"
    class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md"
  >
    <h1 class="text-2xl font-semibold text-navy-700 mb-6 text-center">
      Book your stay!
    </h1>

    <!-- Check-in Date -->
    <div class="mb-4">
      <label for="check_in_date" class="block text-sm font-medium text-navy-700">
        Check-in Date
      </label>
      <input
        type="date"
        id="check_in_date"
        name="check_in_date"
        required
        class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-navy-500"
      />
    </div>

    <!-- Check-out Date -->
    <div class="mb-4">
      <label
        for="check_out_date"
        class="block text-sm font-medium text-navy-700"
      >
        Check-out Date
      </label>
      <input
        type="date"
        id="check_out_date"
        name="check_out_date"
        required
        class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-navy-500"
      />
    </div>

    <!-- Pilih Room -->
    <div class="mb-4">
      <label for="room_id" class="block text-sm font-medium text-navy-700">
        Select Room
      </label>
      <select
        id="room_id"
        name="room_id"
        required
        class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-navy-500"
      >
        <option value="">-- Select Room --</option>
        <?php if (!empty($rooms)) : ?>
          <?php foreach ($rooms as $room) : ?>
            <?php 
              // Skip room nomor 0
              if ($room['room_number'] == 0) {
                continue;
              }
              // Format harga pakai number_format (titik per 000)
              $formattedPrice = number_format($room['price_per_night'], 0, ',', '.');
            ?>
            <option 
              value="<?= $room['id'] ?>" 
              data-price="<?= $room['price_per_night'] ?>"
            >
              <!-- Misal: No. 12 | Deluxe - Rp 1.500.000 -->
              <?= 'No. ' . $room['room_number'] . ' | ' . $room['room_type'] . ' - Rp ' . $formattedPrice ?>
            </option>
          <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>

    <!-- Tampilkan total harga -->
    <div class="mb-6">
      <label for="total_price" class="block text-sm font-medium text-navy-700">
        Total Price
      </label>
      <input
        type="text"
        id="total_price"
        name="total_price"
        readonly
        class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none"
      />
    </div>

    <div>
      <button
        type="submit"
        class="w-full bg-blue-300 text-black font-medium py-2 rounded-lg hover:bg-navy-600 focus:outline-none focus:ring-2 focus:ring-navy-500 focus:ring-offset-2"
      >
        Book and Proceed to Payment
      </button>
    </div>
    <div class="flex justify-center mt-6">
            <a href="/thewijaya/dashboard" 
               class="bg-blue-500 text-white font-semibold py-2 px-6 rounded hover:bg-blue-600 transition duration-300">
                Back to Dashboard
            </a>
        </div>
  </form>

  <script>
    const checkInDate  = document.getElementById('check_in_date');
    const checkOutDate = document.getElementById('check_out_date');
    const roomSelect   = document.getElementById('room_id');
    const totalPrice   = document.getElementById('total_price');

    // Minimal checkOut = 1 hari setelah checkIn
    checkInDate.addEventListener('change', () => {
      const checkInValue = new Date(checkInDate.value);
      checkOutDate.min   = new Date(checkInValue.getTime() + 86400000).toISOString().split('T')[0];
      totalPrice.value   = '';
    });

    // Maksimal checkIn = 1 hari sebelum checkOut
    checkOutDate.addEventListener('change', () => {
      const checkOutValue = new Date(checkOutDate.value);
      checkInDate.max     = new Date(checkOutValue.getTime() - 86400000).toISOString().split('T')[0];
      totalPrice.value    = '';
    });

    // Fungsi helper untuk memformat angka dengan titik (ribuan)
    function formatNumberWithSeparator(num) {
      return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Hitung selisih hari
    function getDayDifference(d1, d2) {
      const oneDayMs = 24 * 60 * 60 * 1000;
      return Math.round((d2 - d1) / oneDayMs);
    }

    // Ketika user memilih Room
    roomSelect.addEventListener('change', () => {
      const pricePerNight = roomSelect.options[roomSelect.selectedIndex].dataset.price;
      if (!pricePerNight) {
        totalPrice.value = '';
        return;
      }

      // Ambil nilai checkIn dan checkOut
      const inDate  = new Date(checkInDate.value);
      const outDate = new Date(checkOutDate.value);

      // Pastikan user sudah isi kedua tanggal
      if (!checkInDate.value || !checkOutDate.value) {
        totalPrice.value = '';
        return;
      }

      // Hitung selisih malam
      const nights = getDayDifference(inDate, outDate);
      if (nights < 1) {
        // Minimal harus 1 malam
        totalPrice.value = '';
        return;
      }

      // Total harga = hargaPermalam * jumlahMalam
      const total = Number(pricePerNight) * nights;

      // Format pakai pemisah ribuan (titik)
      const formattedTotal = formatNumberWithSeparator(total);

      totalPrice.value = formattedTotal;
    });
  </script>
</body>
</html>
