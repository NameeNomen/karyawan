<?php
session_start();
include "../../koneksi.php"; // Tetap di-include jaga-jaga kalau butuh koneksi nanti

// 1. Ambil input dari form
$username = $_POST['username'];
$password = $_POST['password'];

// 2. Cek Manual (Hardcode)
// "Jika username adalah 'admin' DAN password adalah '123'"
if ($username == 'admin' && $password == '123') {
    
    // LOGIN SUKSES MANUAL
    $_SESSION['user'] = 'admin'; // Set nama user di sesi
    header("Location: ../../dashboard.php");
    exit;

} else {
    // 3. Jika bukan admin/123, baru cek ke Database (OPSIONAL)
    // Kalau kamu mau user lain di database tetap bisa login, biarkan bagian ini.
    // Kalau HANYA mau admin 123 saja, hapus blok 'else' ini sampai query database.
    
    $username_db = mysqli_real_escape_string($conn, $username);
    $password_db = md5($password); // Ingat, di database password kamu terenkripsi MD5

    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username_db' AND password='$password_db'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        // LOGIN SUKSES DARI DATABASE
        $_SESSION['user'] = $data['username'];
        header("Location: ../../dashboard.php");
        exit;
    } else {
        // GAGAL TOTAL
        echo "LOGIN GAGAL";
    }
}
?>