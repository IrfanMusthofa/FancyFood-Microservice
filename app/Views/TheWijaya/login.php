<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wijaya Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body>
    <h1>Login to The Wijaya</h1>
    <form action="/thewijaya/login" method="POST">
        <label>Email:</label>
        <input type="email" name="customer_email">
        <label>Password:</label>
        <input type="password" name="password">
        <button type="submit">Login</button>
    </form>
</body>
</html>
