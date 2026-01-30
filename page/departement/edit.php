<?php
include "../../koneksi.php";
include "controller/editController.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Departemen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-emerald-50 min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-64 bg-white shadow-md flex flex-col justify-between">
    <div>
        <div class="p-6 text-2xl font-bold text-emerald-600">
            Admin Panel
        </div>

        <nav class="mt-4 space-y-2 text-gray-700 font-medium">
            <a href="../../dashboard.php" class="flex items-center gap-3 px-6 py-3 hover:bg-emerald-100 rounded-r-full">🏠 Dashboard</a>
            <a href="../karyawan/list.php" class="flex items-center gap-3 px-6 py-3 hover:bg-emerald-100 rounded-r-full">👥 Data Karyawan</a>
            <a href="../jabatan/list.php" class="flex items-center gap-3 px-6 py-3 hover:bg-emerald-100 rounded-r-full">💼 Data Jabatan</a>
            <a href="../departement/list.php" class="flex items-center gap-3 px-6 py-3 bg-emerald-100 text-emerald-700 font-semibold rounded-r-full">🏢 Data Departemen</a>
        </nav>
    </div>

    <div class="p-6">
        <a href="../auth/logout.php"
           class="block w-full bg-red-500 hover:bg-red-600 text-white text-center py-3 rounded-lg font-semibold shadow">
           Logout
        </a>
    </div>
</aside>


<!-- CONTENT -->
<main class="flex-1 flex items-center justify-center p-10">

    <div class="bg-white w-full max-w-2xl p-10 rounded-2xl shadow-lg">

        <h2 class="text-3xl font-bold text-emerald-700 text-center mb-8">
            Edit Departemen
        </h2>

        <form method="post" class="space-y-6">

            <div>
                <label class="block font-semibold mb-2">Nama Departemen</label>
                <input type="text" name="nama_departement"
                    value="<?= htmlspecialchars($row['nama_departement']); ?>"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-emerald-400 focus:outline-none"
                    required>
            </div>

            <div>
                <label class="block font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-emerald-400 focus:outline-none"
                    required><?= htmlspecialchars($row['deskripsi']); ?></textarea>
            </div>

            <!-- BUTTON AREA -->
            <div class="flex gap-4 pt-4">
                <button type="submit" name="update"
                    class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl font-semibold shadow transition">
                    💾 Simpan Perubahan
                </button>

                <a href="list.php"
                   class="flex-1 text-center bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-xl font-semibold shadow transition">
                   Batal
                </a>
            </div>

        </form>
    </div>

</main>

</body>
</html>