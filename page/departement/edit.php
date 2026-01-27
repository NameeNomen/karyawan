<?php
include "koneksi.php";
$id= (int) $_GET['id_departement'];
$data= mysqli_query($conn, "SELECT * FROM departement WHERE id_departement = $id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    echo "gaada datanya";
    exit;
}

if (isset($_POST['update'])) {
    $nama_departement = $_POST['nama_departement'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn, "UPDATE departement SET nama_departement='$nama_departement',
    deskripsi = '$deskripsi' where id_departement = $id");
    exit;
    header("Location : list.php");
}
?>

<form action="" method="post">
    nama departement <input type="text" name="nama_departement" id="">
    <textarea name="" id="" cols="30" rows="10"><?=htmlspecialchars($row['deskripsi']);?></textarea>
    <button name = 'update'>ubah</button>
</form>