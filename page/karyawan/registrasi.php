<?php
session_start();
include "../../koneksi.php";
include "controller/regisController.php";

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
<title>Input Data Karyawan</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<script>
tailwind.config = {
    theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } }
}
</script>

<style>
body { background:#f4fcf8; }
label { font-weight:600; font-size:14px; }
input, select, textarea {
    border:1px solid #ddd;
    padding:12px;
    border-radius:10px;
    width:100%;
}
</style>
</head>

<body class="font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-lg flex flex-col justify-between">
        <div>
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-emerald-600">Admin Panel</h2>
            </div>

            <nav class="p-4 space-y-2">
                <a href="../../dashboard.php" class="block px-4 py-2 rounded-lg hover:bg-emerald-100 font-semibold text-gray-700">🏠 Dashboard</a>
                <a href="list.php" class="block px-4 py-2 rounded-lg bg-emerald-100 font-semibold text-gray-700">👥 Data Karyawan</a>
                <a href="../jabatan/list.php" class="block px-4 py-2 rounded-lg hover:bg-emerald-100 text-gray-700">💼 Data Jabatan</a>
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
    <main class="flex-1 p-10">

        <div class="bg-white rounded-2xl shadow-lg p-10 max-w-5xl mx-auto">

            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-emerald-700">Input Data Karyawan</h2>
                <p class="text-gray-500">Lengkapi data dengan benar</p>
            </div>

            <form method="post" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required>
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div>
                    <label>No HP</label>
                    <input type="number" name="no_hp" required>
                </div>

                <div>
                    <label>NIK</label>
                    <input type="number" name="nik" required>
                </div>

                <div>
                    <label>Status</label>
                    <select name="status">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div>
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" required>
                </div>

                <div>
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" required>
                </div>

                <div class="md:col-span-2">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label>Alamat</label>
                    <textarea name="alamat" rows="3" required></textarea>
                </div>

                <div>
                    <label>Jabatan</label>
                    <select name="id_jabatan" required>
                        <option value="">Pilih Jabatan</option>
                        <?php
                        $q = mysqli_query($conn, "SELECT id_jabatan, nama_jabatan FROM jabatan");
                        while ($j = mysqli_fetch_assoc($q)){
                            echo "<option value='{$j['id_jabatan']}'>{$j['nama_jabatan']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label>Departemen</label>
                    <select name="id_departement" required>
                        <option value="">Pilih Departemen</option>
                        <?php
                        $q = mysqli_query($conn, "SELECT id_departement, nama_departement FROM departement");
                        while ($j = mysqli_fetch_assoc($q)){
                            echo "<option value='{$j['id_departement']}'>{$j['nama_departement']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" required>
                </div>

                <div>
                    <label>Photo KTP</label>
                    <input type="file" name="photo_ktp" required>
                </div>

                <div>
                    <label>Foto Selfie</label>
                    <input type="file" name="foto_selfie" required>
                </div>

                <!-- BUTTON AREA (SAMA KAYA EDIT) -->
                <div class="md:col-span-2 flex justify-between items-center pt-6">

                    <a href="list.php" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                        ← Batal
                    </a>

                    <button type="submit" name="simpan"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-semibold shadow-md text-lg">
                        💾 Simpan Data
                    </button>

                </div>

            </form>
        </div>

    </main>
</div>

</body>
</html>