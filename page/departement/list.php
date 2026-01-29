<?php
include "../../koneksi.php";
include "controller/listController.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Departemen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 p-6">

<div class="max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="relative flex items-center mb-8">

        <!-- Tombol Dashboard -->
        <a href="../../dashboard.php"
           class="absolute left-0 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold shadow-sm">
           ⬅ Dashboard
        </a>

        <!-- Judul Tengah -->
        <h1 class="mx-auto text-3xl font-bold text-emerald-700 tracking-tight">
            Data Departemen
        </h1>

        <!-- Tombol Tambah -->
        <a href="tambah.php"
           class="absolute right-0 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-sm">
           + Tambah Departemen
        </a>

    </div>

    <!-- TABEL -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-emerald-100 text-emerald-800">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Deskripsi</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
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

</div>
</body>
</html>