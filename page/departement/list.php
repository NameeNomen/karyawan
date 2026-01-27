<?php
include "../../koneksi.php";

$data = mysqli_query($conn, "SELECT *FROM departement");
$row = mysqli_fetch_assoc($data);
?>
<table border="1">
    <tr>
        <th>no</th>
        <th>nama departemen</th>
        <th>deskripsi</th>
    </tr>
    <tr>
        <td> <?=$row['id_departement'];?></td>
        <td><?=$row ['nama_departement'];?></td>
        <td><?=$row['deskripsi'];?></td>
</table>