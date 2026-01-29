<?php
include "../../koneksi.php";

/* HAPUS DATA */
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM departement WHERE id_departement = $id");
    header("Location: list.php");
    exit;
}

/* QUERY TAMPIL */
$query = mysqli_query($conn, "SELECT * FROM departement");
?>