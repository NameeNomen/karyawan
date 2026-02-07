<?php
include "../../koneksi.php";

$id = $_GET['id_karyawan'];

// Ambil data lama untuk backup
$data = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan=$id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan";
    exit;
}

if (isset($_POST['ubah'])) {
    $nama_lengkap   = $_POST['nama_lengkap'];
    $nik            = $_POST['nik'];
    $no_hp          = $_POST['no_hp'];
    $alamat         = $_POST['alamat'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $tempat_lahir   = $_POST['tempat_lahir'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $email          = $_POST['email'];
    $tanggal_masuk  = $_POST['tanggal_masuk'];
    $id_jabatan     = $_POST['id_jabatan'];
    $id_departement = $_POST['id_departement'];
    $status         = $_POST['status'];

    // Setup Variabel Batas
    $batas_ukuran = 5242880; // 5MB
    $allowmime = ['image/jpg', 'image/png', 'image/jpeg', 'image/webp'];

    // --- LOGIC FOTO KTP ---
    if ($_FILES['photo_ktp']['error'] === 4) {
        $photo_ktp = $row['photo_ktp']; // Pakai lama
    } else {
        $nama_file_ktp = $_FILES['photo_ktp']['name'];
        $tmp_ktp       = $_FILES['photo_ktp']['tmp_name'];
        $ukuran_ktp    = $_FILES['photo_ktp']['size'];

        // Cek Ukuran
        if ($ukuran_ktp > $batas_ukuran) {
            tampilkanAlert('error', 'Gagal Upload', 'Ukuran KTP terlalu besar (Max 5MB)', true);
        }

        // Cek Tipe
        $mime = mime_content_type($tmp_ktp);
        if (!in_array($mime, $allowmime)) {
            tampilkanAlert('error', 'Gagal Upload', 'Format KTP harus Gambar (JPG/PNG)', true);
        }

        move_uploaded_file($tmp_ktp, "../../upload/" . $nama_file_ktp);
        $photo_ktp = $nama_file_ktp;
    }

    // --- LOGIC FOTO SELFIE ---
    if ($_FILES['foto_selfie']['error'] === 4) {
        $foto_selfie = $row['foto_selfie']; // Pakai lama
    } else {
        $foto_selfie_nama = $_FILES['foto_selfie']['name'];
        $tmp_selfie       = $_FILES['foto_selfie']['tmp_name'];
        $size             = $_FILES['foto_selfie']['size'];

        // Cek Ukuran
        if ($size > $batas_ukuran) {
            tampilkanAlert('error', 'Gagal Upload', 'Ukuran Selfie terlalu besar (Max 5MB)', true);
        }

        // Cek Tipe
        $mime = mime_content_type($tmp_selfie);
        if (!in_array($mime, $allowmime)) {
            tampilkanAlert('error', 'Gagal Upload', 'Format Selfie harus Gambar (JPG/PNG)', true);
        }
        
        move_uploaded_file($tmp_selfie, "../../upload/" . $foto_selfie_nama);
        $foto_selfie = $foto_selfie_nama;
    }

    // --- QUERY UPDATE ---
    $query = "UPDATE karyawan SET 
    nama_lengkap='$nama_lengkap',
    nik='$nik',
    no_hp='$no_hp',
    alamat='$alamat',
    jenis_kelamin='$jenis_kelamin',
    tempat_lahir='$tempat_lahir',
    tanggal_lahir='$tanggal_lahir',
    email='$email',
    photo_ktp='$photo_ktp',
    foto_selfie='$foto_selfie',
    tanggal_masuk ='$tanggal_masuk',
    status = '$status',
    id_jabatan = '$id_jabatan',
    id_departement ='$id_departement'
    WHERE id_karyawan=$id";

    $result = mysqli_query($conn, $query);

    // --- HASIL AKHIR ---
    if ($result) {
        // SUKSES -> Redirect ke List.php
        tampilkanAlert('success', 'Berhasil!', 'Data pegawai berhasil diperbarui.', false, 'list.php');
    } else {
        // GAGAL SQL -> Kembali
        tampilkanAlert('error', 'Terjadi Kesalahan', mysqli_error($conn), true);
    }
}

// ==========================================
// FUNGSI KHUSUS SWEETALERT (JANGAN DIHAPUS)
// ==========================================
function tampilkanAlert($icon, $title, $text, $back = false, $redirect = null) {
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <style>body { font-family: sans-serif; background-color: #f3f4f6; }</style>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: '$icon',
                title: '$title',
                text: '$text',
                confirmButtonColor: '#10b981', // Warna Hijau Emerald
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    ";
                    
                    if ($back) {
                        echo "window.history.back();"; // Mundur ke form edit
                    } elseif ($redirect) {
                        echo "window.location.href = '$redirect';"; // Pindah ke list
                    }
                    
    echo "      }
            });
        </script>
    </body>
    </html>
    ";
    exit; // PENTING: Matikan script PHP di sini
}
?>