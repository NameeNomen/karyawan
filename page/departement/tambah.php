<?php
include "../../koneksi.php";

if (isset($_POST['simpan'])) {
    $nama_departement = $_POST['nama_departement'];
    $deskripsi = $_POST['deskripsi'];

    $queri = "INSERT INTO departement(nama_departement, deskripsi) 
              VALUES ('$nama_departement','$deskripsi')";

    if (mysqli_query($conn, $queri)) {
        header("Location: list.php");
        exit;
    } else {
        echo "Gagal : " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Departemen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f7faf9; }
    </style>
</head>
<body class="p-6 md:p-12">

<div class="max-w-2xl mx-auto">

    <!-- Header -->
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Departemen</h1>
            <p class="text-emerald-600">Masukkan data departemen baru</p>
        </div>
        <a href="list.php"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold transition">
           ⬅ Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-emerald-100">
        <form method="post" class="space-y-6">

            <!-- Nama Departemen -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Departemen
                </label>
                <input type="text" name="nama_departement" required
                       class="w-full px-4 py-2.5 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:outline-none">
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea name="deskripsi" rows="4" required
                          class="w-full px-4 py-2.5 border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-400 focus:outline-none"></textarea>
            </div>

            <!-- Button -->
            <div class="pt-4">
                <button type="submit" name="simpan"
                        class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-lg font-semibold shadow-sm transition">
                    Simpan Departemen
                </button>
            </div>

        </form>
    </div>

</div>

</body>
</html>