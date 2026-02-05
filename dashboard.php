<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

$nama_user = $_SESSION['nama'] ?? 'Admin';

$total_karyawan = 0;
$query_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM karyawan");
if ($query_count) {
    $data_count = mysqli_fetch_assoc($query_count);
    $total_karyawan = $data_count['total'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Kepegawaian</title>

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

                <a href="dashboard.php"
                   class="block px-4 py-2 rounded-lg hover:bg-emerald-100 font-semibold text-gray-700">
                   🏠 Dashboard
                </a>

                <a href="page/karyawan/list.php"
                   class="block px-4 py-2 rounded-lg hover:bg-emerald-100 text-gray-700">
                   👥 Data Karyawan
                </a>

                <a href="page/jabatan/list.php"
                   class="block px-4 py-2 rounded-lg hover:bg-emerald-100 text-gray-700">
                   💼 Data Jabatan
                </a>

                <a href="page/departement/list.php"
                   class="block px-4 py-2 rounded-lg hover:bg-emerald-100 text-gray-700">
                   🏢 Data Departemen
                </a>

            </nav>
        </div>

        <!-- LOGOUT -->
        <div class="p-4 border-t">
            <a href="page/auth/logout.php"
               class="block text-center bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg font-semibold">
               Logout
            </a>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10">

        <h1 class="text-2xl font-bold mb-6 text-emerald-700">
            Halo, <?= htmlspecialchars($nama_user); ?> 👋
        </h1>

        <div class="bg-white p-8 rounded-2xl shadow mb-6">
            <p class="text-gray-500">Sistem kepegawaian aktif dan siap digunakan.</p>
        </div>

        <div class="bg-emerald-500 text-white p-8 rounded-2xl shadow mb-8">
            <p class="uppercase text-sm">Total Pegawai Aktif</p>
            <h2 class="text-5xl font-bold"><?= $total_karyawan; ?></h2>
        </div>

        <!-- MENU CEPAT -->
        <div class="grid md:grid-cols-3 gap-6">

            <a href="page/karyawan/registrasi.php" class="bg-emerald-100 p-6 rounded-xl shadow hover:scale-105 transition">
                Tambah Pegawai
            </a>

            <a href="page/departement/tambah.php" class="bg-teal-100 p-6 rounded-xl shadow hover:scale-105 transition">
                Tambah Divisi
            </a>

            <a href="page/jabatan/tambah.php" class="bg-sky-100 p-6 rounded-xl shadow hover:scale-105 transition">
                Tambah Jabatan
            </a>

        </div>

    </main>

</div>
</body>
</html>
