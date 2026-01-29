<?php
include "../../koneksi.php";

$id = $_GET['id_karyawan'];
$data = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan=$id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
   echo "data gaada";
   exit;
}
if (isset($_POST['ubah'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $email = $_POST['email'];
    $photo_ktp =$_FILES['photo_ktp']['name'];
    $foto_selfie=$_FILES['foto_selfie']['name'];
    $tanggal_masuk =$_POST['tanggal_masuk'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_departement = $_POST['id_departement'];
    $status = $_POST['status'];

    $allowmime = ['image/jpg','image/png','image/jpeg','image/webp'];
     foreach (['photo_ktp','foto_selfie'] as $value) {
        $mime = mime_content_type($_FILES[$value]['tmp_name']);
        if (!in_array($mime, $allowmime)) {
            echo 'file bukan gambar';
            exit;
        }
     }
    move_uploaded_file($_FILES['photo_ktp']['tmp_nsme'], "upload/".$photo_ktp);
    move_uploaded_file($_FILES['foto_Selfie']['tmp_nsme'], "upload/".$foto_Selfie);

    

    mysqli_query ($conn , "UPDATE karyawan SET 
    nama_lengkap='$nama_lengkap',
    nik=$nik,
    no_hp=$no_hp,
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
     WHERE id_karyawan=$id");
    header("Location: list.php");


 }
?>