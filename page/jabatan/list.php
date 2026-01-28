<?php
include "../../koneksi.php";

/* HAPUS */
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM jabatan WHERE id_jabatan=$id");
    header("Location: list.php");
    exit;
}

/* CEK & ISI DATA DUMMY */
$cek = mysqli_query($conn, "SELECT COUNT(*) as total FROM jabatan");
$d = mysqli_fetch_assoc($cek);
if ($d['total'] == 0) {
    mysqli_query($conn, "INSERT INTO jabatan (nama_jabatan, deskripsi) VALUES
        ('Supervisor', 'Mengawasi jalannya operasional'),
        ('Operator', 'Menjalankan mesin produksi'),
        ('Admin', 'Mengelola data dan laporan'),
        ('Teknisi', 'Perawatan dan perbaikan mesin'),
        ('Manager', 'Mengatur keseluruhan tim')");
}

/* QUERY */
$query = mysqli_query($conn, "SELECT * FROM jabatan");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Jabatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 p-6">

<div class="max-w-5xl mx-auto">

    <div class="relative flex items-center mb-8">
        <a href="../../dashboard.php"
           class="absolute left-0 bg-gray-200 px-4 py-2 rounded-lg text-sm font-semibold">
           ⬅ Dashboard
        </a>

        <h1 class="mx-auto text-3xl font-bold text-emerald-700">Data Jabatan</h1>

        <a href="tambah.php"
           class="absolute right-0 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
           + Tambah Jabatan
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-emerald-100">
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
                    <td class="p-4"><?= $row['id_jabatan']; ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['nama_jabatan']); ?></td>
                    <td class="p-4"><?= htmlspecialchars($row['deskripsi']); ?></td>
                    <td class="p-4 text-center space-x-2">
                        <a href="edit.php?id_jabatan=<?= $row['id_jabatan']; ?>"
                           class="bg-yellow-400 text-white text-xs px-3 py-1 rounded">Edit</a>
                        <a href="?hapus=<?= $row['id_jabatan']; ?>"
                           onclick="return confirm('Hapus data?')"
                           class="bg-red-500 text-white text-xs px-3 py-1 rounded">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>