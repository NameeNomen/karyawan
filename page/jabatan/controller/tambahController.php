<?php
include "../../koneksi.php";

if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO jabatan (nama_jabatan, deskripsi)
        VALUES ('$_POST[nama_jabatan]', '$_POST[deskripsi]')");
    header("Location: list.php");
    exit;
}
?>