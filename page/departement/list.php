<?php
session_start();
include "../../koneksi.php";
include "controller/listController.php";

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
<title>Data Departemen</title>

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

    <!-- ✅ SIDEBAR STANDAR -->
    <aside class="w-64 bg-white shadow-lg flex flex-col justify-between">

        <div>
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-emerald-600">Admin Panel</h2>
            </div>

            <nav class="p-4 space-y-2">

                <a href="../../dashboard.php"
                   class="block px-4 py-2 rounded-lg hover:bg-emerald-100 font-semibold text-gray-700">
                   🏠 Dashboard
                </a>

                <a href="../karyawan/list.php"
                   class="block px-4 py-2 rounded-lg hover:bg-emerald-100 text-gray-700">
                   👥 Data Karyawan
                </a>

                <a href="../jabatan/list.php"
                   class="block px-4 py-2 rounded-lg hover:bg-emerald-100 text-gray-700">
                   💼 Data Jabatan
                </a>

                <a href="list.php"
                   class="block px-4 py-2 rounded-lg bg-emerald-100 font-semibold text-gray-700">
                   🏢 Data Departemen
                </a>

            </nav>
        </div>

        <div class="p-4 border-t">
            <a href="../auth/logout.php"
               class="block text-center bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg font-semibold">
               Logout
            </a>
        </div>

    </aside>

    <!-- ✅ CONTENT -->
    <main class="flex-1 p-10">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-emerald-700">Data Departemen</h1>

            <a href="tambah.php"
               class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg font-semibold shadow">
               + Tambah Departemen
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-emerald-100 text-emerald-800 text-sm uppercase">
                    <tr>
                        <th class="p-4">ID</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Deskripsi</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                    <tr class="border-t hover:bg-emerald-50">
                        <td class="p-4"><?= $row['id_departement']; ?></td>
                        <td class="p-4"><?= htmlspecialchars($row['nama_departement']); ?></td>
                        <td class="p-4"><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td class="p-4 text-center space-x-2">

                            <a href="edit.php?id_departement=<?= $row['id_departement']; ?>"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1 rounded-lg">
                               Edit
                            </a>

                            <a href="?hapus=<?= $row['id_departement']; ?>"
                               onclick="return confirm('Yakin hapus data ini?')"
                               class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded-lg">
                               Hapus
                            </a>

                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </main>

</div>

</body>
</html>