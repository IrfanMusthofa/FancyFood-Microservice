<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Payment Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
      background: url('/images/wijaya1.png') no-repeat center center/cover;
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
  <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md relative">
    <h1 class="text-2xl font-semibold text-navy-700 mb-6 text-center">
      Payment Details
    </h1>

    <?php
      // Pastikan data booking tersedia
      // Booking fields:
      // - booking.id
      // - booking.customer_id
      // - booking.check_in_date
      // - booking.check_out_date
      // - booking.total_price
      // - booking.paid
      // plus join:
      // - booking.room_number
      // - booking.room_type
      // - booking.price_per_night
      $formattedPrice = number_format($booking['total_price'], 0, ',', '.');
    ?>

    <!-- Rincian Booking -->
    <div class="mb-4">
      <p><strong>Booking ID:</strong> <?= $booking['id'] ?></p>
      <p><strong>Room No:</strong> <?= $booking['room_number'] ?></p>
      <p><strong>Room Type:</strong> <?= $booking['room_type'] ?></p>
      <p><strong>Check-in Date:</strong> <?= $booking['check_in_date'] ?></p>
      <p><strong>Check-out Date:</strong> <?= $booking['check_out_date'] ?></p>
      <p><strong>Total Price:</strong> Rp <?= $formattedPrice ?></p>
    </div>

    <!-- Form Payment -->
    <form method="POST" action="/thewijaya/payment/processPayment">
      <!-- Supaya kita tahu booking mana yang dibayar -->
      <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>" />
      <input type="hidden" name="amount" value="<?= $booking['total_price'] ?>" />

      <div class="mb-4">
        <label class="block text-sm font-medium text-navy-700 mb-2">
          Payment Method
        </label>
        <select 
          name="payment_method" 
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-navy-500"
          required
        >
          <option value="">-- Select Method --</option>
          <option value="Credit Card">QRIS</option>
          <option value="Bank Transfer">GoPay</option>
          <option value="E-Wallet">Debit and Credit</option>
        </select>
      </div>

      <button
        type="submit"
        class="w-full mt-4 bg-blue-300 text-black font-medium py-2 rounded-lg hover:bg-navy-600 focus:outline-none focus:ring-2 focus:ring-navy-500 focus:ring-offset-2"
      >
        Pay Now
      </button>
    </form>
  </div>
</body>
</html>
