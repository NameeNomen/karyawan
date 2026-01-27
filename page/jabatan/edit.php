<?php 

include "koneksi.php";

$id = (int) $_GET['id_jabatan'];
$data = mysqli_query($conn, "SELECT *FROM jabatan WHERE id_jabatan = $id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
   echo "data gaada";
   exit;
   
}
if (isset($_POST['update'])) {
    $nama_jabatan = $_POST['nama_jabatan'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn, "UPDATE jabatan SET nama_jabatan = '$nama_jabatan', deskripsi = '$deskripsi' WHERE id_jabatan = $id
    ");
    header("Location: list.php");
    exit;

}

?>
<form action="" method="post">
 nama jabatan <input type="text" name="nama_jabatan" value="<?= $row['nama_jabatan'];?>" id="">
 <textarea name="deskripsi" id="" cols="30" rows="10"><?= htmlspecialchars($row['deskripsi']);?></textarea>
 <button name = "update">ubah</button>
</form>