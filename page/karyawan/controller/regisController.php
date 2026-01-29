<?php

include "../../koneksi.php";

 if (isset($_POST['simpan'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $email = $_POST['email'];
    $photo_ktp = $_FILES['photo_ktp']['name'];
    $foto_selfie =$_FILES['foto_selfie']['name'];
    $tanggal_masuk =$_POST['tanggal_masuk'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_departement = $_POST['id_departement'];
    $status = $_POST ['status'];

    $allowmime = ['image/jpeg','image/png','image/webp','image/jpg'];

    foreach (['photo_ktp','foto_selfie'] as $value) {
    $mime = mime_content_type($_FILES[$value]['tmp_name']);
     if(!in_array($mime, $allowmime)){
        echo "file $value bukan gambar";
        exit;
    }
    }

    move_uploaded_file($_FILES['photo_ktp']['tmp_name'], "../../upload/".$photo_ktp);
    move_uploaded_file($_FILES['foto_selfie']['tmp_name'], "../../upload/".$foto_selfie);
    
    $cek = mysqli_query($conn, "SELECT nik from karyawan where nik = '$nik'");
    if (mysqli_num_rows($cek)>0) {
        echo "nik dah terdaftar";
        exit;
        # code...
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
    foto_selfie
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
    '$foto_selfie'
)";


   if(mysqli_query($conn, $queri)){
        header("location: list.php");
        exit;

    }else{
        echo "gagal simpen: ". mysqli_error($conn);
    }



 }
?>