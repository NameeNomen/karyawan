<?php
include "../../koneksi.php";

if (isset($_POST['simpan'])){
    $nama_jabatan = $_POST['nama_jabatan'];
    $deskripsi = $_POST['deskripsi'];

    $queri= "INSERT INTO jabatan(nama_jabatan, deskripsi)
    VALUES('$nama_jabatan','$deskripsi')";

    if (mysqli_query($conn,$queri)) {
        header("Location: list.php");
        exit;
    }else{
        echo 'gagal : '. mysqli_error($conn);
    }
}
?>

<form action="" method="post">
    nama jabatan <input type="text" name="nama_jabatan" required>
    deskripsi <textarea name="deskripsi" id="" cols="30" rows="10"></textarea>
    <button type="submit" name="simpan">tambah</button>
</form>