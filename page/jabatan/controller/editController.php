<?php
include "../../koneksi.php";

$id = (int) $_GET['id_jabatan'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jabatan WHERE id_jabatan=$id"));

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE jabatan SET
        nama_jabatan='$_POST[nama_jabatan]',
        deskripsi='$_POST[deskripsi]'
        WHERE id_jabatan=$id");
    header("Location: list.php");
    exit;
}
?>