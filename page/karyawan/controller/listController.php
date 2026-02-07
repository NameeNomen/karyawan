<?php
include "../../koneksi.php";

$limit =12;
$page = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;
$statusFilter = isset($_GET['status']) && $_GET['status'] == 'nonaktif' ? 'nonaktif' : 'aktif';

$cari = isset($_GET['search'])? mysqli_real_escape_string($conn, $_GET['search']) : '';
$whereClause = "WHERE k.status = '$statusFilter'";
if ($cari !='') {
    $whereClause .= " AND (k.nama_lengkap LIKE '%$cari%' OR k.nik LIKE '%$cari%')";
}

$data =  "SELECT  k.id_karyawan, 
k.nama_lengkap,
k.email,
k.nik,
k.alamat,
k.no_hp,
k.jenis_kelamin,
k.tempat_lahir,
k.tanggal_lahir,
k.foto_selfie,
k.photo_ktp,
k.tanggal_masuk,
k.status,
j.nama_jabatan,
d.nama_departement
FROM karyawan k
JOIN jabatan j on k.id_jabatan = j.id_jabatan
JoIN departement d on k.id_departement = d.id_departement
$whereClause order by k.nama_lengkap asc LIMIT $start, $limit";

$hasil = mysqli_query($conn,$data);



$queri = "SELECT COUNT(*) as total 
               FROM karyawan k 
               INNER JOIN jabatan j on k.id_jabatan = j.id_jabatan
               INNER JOIN departement d on k.id_departement = d.id_departement
               $whereClause";

$result = mysqli_query($conn,$queri);
$rowTotal = mysqli_fetch_assoc($result);
$totalData = $rowTotal['total'];
$totalHalaman = ceil($totalData/$limit);

$queryAktif = mysqli_query($conn, "SELECT count(*) as c from karyawan where status = 'aktif'");
$countAktif = mysqli_fetch_assoc($queryAktif)['c'];

$queriNonAktif = mysqli_query($conn,"SELECT count(*) as c from karyawan where status ='nonaktif'");
$countNA = mysqli_fetch_assoc($queriNonAktif)['c'];
?>