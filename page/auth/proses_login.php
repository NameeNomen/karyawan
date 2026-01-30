<?php
session_start();
include "../../koneksi.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = md5($_POST['password']);

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['user'] = $data['username'];
    header("Location: ../../dashboard.php"); // FIXED
    exit;
} else {
    echo "LOGIN GAGAL";
}
?>