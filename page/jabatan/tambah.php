<?php
include "../../koneksi.php";
include "controller/tambahController.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Jabatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 flex justify-center items-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow w-full max-w-xl">
    <h2 class="text-2xl font-bold mb-6 text-emerald-700">Tambah Jabatan</h2>
    <form method="post" class="space-y-4">
        <input type="text" name="nama_jabatan" placeholder="Nama Jabatan"
            class="w-full px-4 py-2 border rounded-lg" required>
        <textarea name="deskripsi" placeholder="Deskripsi"
            class="w-full px-4 py-2 border rounded-lg" required></textarea>
        <button name="simpan"
            class="w-full bg-emerald-500 text-white py-2 rounded-lg">Simpan</button>
    </form>
</div>

</body>
</html>