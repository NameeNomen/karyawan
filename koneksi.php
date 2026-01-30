<?php
$host = "localhost";
$user = "root";
$port="3306";
$pass = "";
$db   = "db_karyawan";

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
