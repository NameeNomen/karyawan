<?php
include "../../koneksi.php";


$data = mysqli_query ($conn, "SELECT  k.id_karyawan, 
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
j.nama_jabatan,
d.nama_departement
FROM karyawan k
JOIN jabatan j on k.id_jabatan = j.id_jabatan
JoIN departement d on k.id_departement = d.id_departement;
");


?>