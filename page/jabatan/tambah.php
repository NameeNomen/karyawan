<?php
session_start();
include "../../koneksi.php";
include "controller/tambahController.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Jabatan</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<script>
tailwind.config = {
    theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } }
}
</script>
</head>

<body class="bg-[#f4fcf8] font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-lg flex flex-col justify-between">
        <div>
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-emerald-600">Admin Panel</h2>
            </div>

            <nav class="p-4 space-y-2">
                <a href="../../dashboard.php" class="block px-4 py-2 rounded-lg hover:bg-emerald-100 font-semibold text-gray-700">🏠 Dashboard</a>
                <a href="../karyawan/list.php" class="block px-4 py-2 rounded-lg hover:bg-emerald-100 text-gray-700">👥 Data Karyawan</a>
                <a href="../jabatan/list.php" class="block px-4 py-2 rounded-lg bg-emerald-100 font-semibold text-gray-700">💼 Data Jabatan</a>
                <a href="../departement/list.php" class="block px-4 py-2 rounded-lg hover:bg-emerald-100 text-gray-700">🏢 Data Departemen</a>
            </nav>
        </div>

        <div class="p-4 border-t">
            <a href="../auth/logout.php" class="block text-center bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg font-semibold">
                Logout
            </a>
        </div>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 flex justify-center items-center p-10">

        <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-xl">

            <h2 class="text-2xl font-bold text-emerald-700 mb-6 text-center">
                Tambah Jabatan
            </h2>

            <form method="post" class="space-y-5">

                <div>
                    <label class="font-semibold text-sm">Nama Jabatan</label>
                    <input type="text" name="nama_jabatan"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                        required>
                </div>

                <div>
                    <label class="font-semibold text-sm">Deskripsi</label>
                    <textarea name="deskripsi"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                        required></textarea>
                </div>

                <!-- BUTTON AREA -->
                <div class="flex gap-4 pt-4">
                    <button type="submit" name="simpan"
                        class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl font-semibold shadow transition">
                        💾 Simpan Jabatan
                    </button>

                    <a href="list.php"
                       class="flex-1 text-center bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-xl font-semibold shadow transition">
                       Batal
                    </a>
                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>