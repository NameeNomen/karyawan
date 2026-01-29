<?php
include "../../koneksi.php";

$id = (int) $_GET['id_departement'];
$data = mysqli_query($conn, "SELECT * FROM departement WHERE id_departement = $id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "Data tidak ditemukan";
    exit;
}

if (isset($_POST['update'])) {
    $nama_departement = $_POST['nama_departement'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn, "UPDATE departement SET
        nama_departement='$nama_departement',
        deskripsi='$deskripsi'
        WHERE id_departement=$id");

    header("Location: list.php");
    exit;
}
?>