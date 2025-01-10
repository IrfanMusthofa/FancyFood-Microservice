<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Payment Successful</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
  <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md relative text-center">
    <h1 class="text-2xl font-semibold text-navy-700 mb-6">Payment Successful!</h1>
    <p class="mb-6">Thank you for your payment. We have received your transaction.</p>
    <div>
      <a 
        href="/thewijaya/dashboard"
        class="inline-block bg-blue-500 text-white font-semibold py-2 px-6 rounded hover:bg-blue-600 transition duration-300"
      >
        Back to Dashboard
      </a>
    </div>
  </div>
</body>
</html>
