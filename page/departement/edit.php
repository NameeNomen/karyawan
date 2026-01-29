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
<body class="bg-emerald-50 min-h-screen flex items-center justify-center p-6">

<div class="bg-white w-full max-w-2xl p-8 rounded-xl shadow border border-emerald-100">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-emerald-700">Edit Departemen</h2>
        <a href="list.php" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm font-semibold">
            ⬅ Kembali
        </a>
    </div>

    <form method="post" class="space-y-5">

        <div>
            <label class="block text-sm font-semibold mb-1">Nama Departemen</label>
            <input type="text" name="nama_departement"
                value="<?= htmlspecialchars($row['nama_departement']); ?>"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400" required>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400"
                required><?= htmlspecialchars($row['deskripsi']); ?></textarea>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" name="update"
                class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded-lg font-semibold">
                Simpan Perubahan
            </button>

            <a href="list.php"
               class="flex-1 text-center bg-gray-300 hover:bg-gray-400 py-2 rounded-lg font-semibold">
               Batal
            </a>
        </div>

    </form>
</div>

</body>
</html>