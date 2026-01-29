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