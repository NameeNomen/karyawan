<?php
include "../../koneksi.php";

if (!isset($_GET['id_karyawan'])) {
    echo "data tidak ada";
    exit;
}

$id = $_GET['id_karyawan'];

$data = mysqli_query($conn,"SELECT photo_ktp, foto_selfie from karyawan where id_karyawan='$id'");
$row = mysqli_fetch_assoc($data);

if ($row) {
    if (!empty($row['photo_ktp'])) {
        @unlink("../../upload".$row['photo_ktp']);
    }
    if ($row) {
        if (!empty($row['foto_selfie'])) {
            @unlink("../../upload".$row['foto_selfie']);

        }
    }
    $queri=mysqli_query($conn,"DELETE from karyawan where id_karyawan='$id'");
    if ($queri) {
       header("Location: list.php");
       exit;
    }else{
        echo "gagal hapus";
    }
}