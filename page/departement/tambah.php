<?php
include "../../koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_departement = $_POST['nama_departement'];
    $deskripsi = $_POST['deskripsi'];

    $queri = "INSERT INTO departement(nama_departement,deskripsi) 
    VALUES ('$nama_departement','$deskripsi')";

    if (mysqli_query($conn, $queri)) {
        header("Location: list.php");
        exit;
    }else{
        echo "gagal : ". mysqli_error($conn);
    }
}
?>
<form action="" method="post">
    namaDepartement <input type="text" name="nama_departement" id="">
    deskripsi <textarea name="deskripsi" id="" cols="30" rows="10"></textarea>
    <button name="simpan">tambah</button>
</form>
