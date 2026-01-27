<?php
include "../../koneksi.php";

$data = mysqli_query($conn, "SELECT *FROM jabatan");
$row = mysqli_fetch_assoc($data);
?>
<table border="1">
    <tr>
        <th>no</th>
        <th>nama jabatan</th>
        <th>deskripsi</th>
    </tr>
    <tr>
        <td> <?=$row['id_jabatan'];?></td>
        <td><?=$row ['nama_jabatan'];?></td>
        <td><?=$row['deskripsi'];?></td>
</table>