<?php
include "../../../koneksi.php";

// 1. Cek apakah ada ID Karyawan yang dikirim
if (isset($_GET['id_karyawan'])) {
    
    // Amankan data input
    $id = mysqli_real_escape_string($conn, $_GET['id_karyawan']);

    // 2. Query Update Status menjadi 'aktif'
    $query = "UPDATE karyawan SET status = 'aktif' WHERE id_karyawan = '$id'";
    $hasil = mysqli_query($conn, $query);

    // 3. Cek keberhasilan dan Redirect
    if ($hasil) {
        echo "<script>
                alert('Berhasil! Pegawai telah diaktifkan kembali.');
                // Redirect kembali ke halaman Non-Aktif supaya bisa lihat sisa list
                window.location.href = '../list.php?status=nonaktif'; 
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengaktifkan pegawai: " . mysqli_error($conn) . "');
                window.location.href = '../list.php?status=nonaktif';
              </script>";
    }

} else {
    // Kalau tidak ada ID, kembalikan ke index
    header("Location:../list.php?status=nonaktif");
}
?>