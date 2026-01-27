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
<table border="1">
 <th>foto selfie</th>
        <th>nama</th>
        <th>nama jabatan</th>
        <th>nama departement</th>
        <th>status</th>
        
<th>nama lengkap</th>
<th>email</th>
        <th>nik</th>
        <th>no hp</th>
        <th>alamat</th>
        <th>jenis kelamin</th>
        <th>tempat lahir</th>
        <th>tanggal lahir</th>
         <th>photo ktp</th>
        <th>tanggal masuk</th>

         <?php while ($row = mysqli_fetch_assoc($data)){
        ?>
        <tr>
            <td>
                <img src ="../../upload/<?= $row['foto_selfie'];?>" width="100px">
            </td>
            <td><?= $row['nama_lengkap'];?></td>
             <td><?= $row['nama_jabatan'];?></td>
            <td><?= $row ['nama_departement'];?></td>   


        </tr>
<td><?= $row['email'];?></td>
            <td><?= $row['nik'];?></td>
            <td><?= $row['no_hp'];?></td>
            <td><?= $row['alamat'];?></td>
            <td><?= $row['jenis_kelamin'];?></td>
            <td><?= $row['tempat_lahir'];?></td>
            <td><?= $row['tanggal_lahir'];?></td>
             <td>
                <img src ="../../upload/<?= $row['photo_ktp'];?>" width="100px">
            </td>
            <td><?= $row['tanggal_masuk'];?></td>
    <?php } ?>

</table>