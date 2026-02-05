<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../../dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
    <h2 class="text-3xl font-bold text-center text-emerald-600 mb-6">Login Sistem</h2>

    <?php if (isset($_GET['error'])) : ?>
        <p class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">Username atau Password salah</p>
    <?php endif; ?>

    <form method="POST" action="proses_login.php" class="space-y-4">
        <input type="text" name="username" placeholder="Username"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400" required>

        <button class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded-lg font-semibold">
            Login
        </button>
    </form>
</div>

</body>
</html>