<?php
include "../../koneksi.php";

if (isset($_POST['simpan'])) {
    $nama_departement = $_POST['nama_departement'];
    $deskripsi = $_POST['deskripsi'];

    $queri = "INSERT INTO departement(nama_departement, deskripsi) 
              VALUES ('$nama_departement','$deskripsi')";

    if (mysqli_query($conn, $queri)) {
        header("Location: list.php");
        exit;
    } else {
        echo "Gagal : " . mysqli_error($conn);
    }
}
?>