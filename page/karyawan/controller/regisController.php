


<?php
session_start();
include "../../koneksi.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 if (isset($_POST['simpan'])) {

    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $email = $_POST['email'];
    // $photo_ktp = $_FILES['photo_ktp']['name'];
    // $foto_selfie =$_FILES['foto_selfie']['name'];
    $tanggal_masuk =$_POST['tanggal_masuk'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_departement = $_POST['id_departement'];
    $status = $_POST ['status'];
    $nip = $_POST ['nip'];



    $batas_size = 5000000;

    $size_ktp = $_FILES['photo_ktp']['size'];
    $ktp_file_name = $_FILES['photo_ktp']['name'];
    $tmp_ktp = $_FILES['photo_ktp']['tmp_name'];


    if ($size_ktp > $batas_size) {
                  tampilkanAlert('error', 'Gagal Upload', 'Ukuran Selfie terlalu besar (Max 5MB)', true);


    }
        $allowmime = ['image/jpeg','image/png','image/webp','image/jpg'];

    $mime = mime_content_type($tmp_ktp);
     if(!in_array($mime, $allowmime)){
                   tampilkanAlert('error', 'Gagal Upload', 'File Bukan Gambar', true);


    }
    

    move_uploaded_file($tmp_ktp, "../../upload/".$ktp_file_name);
    $photo_ktp = $ktp_file_name;

    $batas_size = 5000000;
    $foto_selfie = $_FILES['foto_selfie']['name'];
    $tmp_selfie = $_FILES['foto_selfie']['tmp_name'];
    $size_selfie = $_FILES['foto_selfie']['size'];

    if ($size_selfie > $batas_size) {
                      tampilkanAlert('error', 'Gagal Upload', 'Ukuran Selfie terlalu besar (Max 5MB)', true);

    }

    $allowmime = ['image/jpeg','image/png','image/webp','image/jpg'];

    $mime = mime_content_type($tmp_selfie);
     if(!in_array($mime, $allowmime)){
                    tampilkanAlert('error', 'Gagal Upload', 'File bukan gambar', true);

     }



    move_uploaded_file($tmp_selfie, "../../upload/".$foto_selfie);

    
    $cek = mysqli_query($conn, "SELECT nik from karyawan where nik = '$nik'");

        if (mysqli_num_rows($cek) > 0) {
                tampilkanAlert('error', 'Gagal Upload', 'Nik sudah terdaftar', true);
}


   $queri = "INSERT INTO karyawan (
    nik,
    nama_lengkap,
    email,
    no_hp,
    alamat,
    jenis_kelamin,
    tempat_lahir,
    tanggal_lahir,
    id_jabatan,
    status,
    id_departement,
    tanggal_masuk,
    photo_ktp,
    foto_selfie,
    nip
) VALUES (
    '$nik',
    '$nama_lengkap',
    '$email',
    '$no_hp',
    '$alamat',
    '$jenis_kelamin',
    '$tempat_lahir',
    '$tanggal_lahir',
    $id_jabatan,
    '$status',
    $id_departement,
    '$tanggal_masuk',
    '$photo_ktp',
    '$foto_selfie',
    '$nip'
)";


   if(mysqli_query($conn, $queri)){
            tampilkanAlert('success', 'Berhasil!', 'Data pegawai berhasil diperbarui.', false, 'list.php');


    }else{
        tampilkanAlert('error', 'Terjadi Kesalahan', mysqli_error($conn), true);
    }



 }

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