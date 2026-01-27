<?php

include "../../koneksi.php";

 if (isset($_POST['simpan'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $email = $_POST['email'];
    $photo_ktp = $_FILES['photo_ktp']['name'];
    $foto_selfie =$_FILES['foto_selfie']['name'];
    $tanggal_masuk =$_POST['tanggal_masuk'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_departement = $_POST['id_departement'];
    $status = $_POST ['status'];

    $allowmime = ['image/jpeg','image/png','image/webp','image/jpg'];

    foreach (['photo_ktp','foto_selfie'] as $value) {
    $mime = mime_content_type($_FILES[$value]['tmp_name']);
     if(!in_array($mime, $allowmime)){
        echo "file $value bukan gambar";
        exit;
    }
    }

    move_uploaded_file($_FILES['photo_ktp']['tmp_name'], "../../upload/".$photo_ktp);
    move_uploaded_file($_FILES['foto_selfie']['tmp_name'], "../../upload/".$foto_selfie);
    
    

   $queri = "INSERT INTO karyawan (
    nik,
    nama_lengkap,
    email,
    no_hp,
    alamat,
    jenis_kelamin,
    tempat_lahir,
    tanggal_lahir,
    id_jabatan,
    status,
    id_departement,
    tanggal_masuk,
    photo_ktp,
    foto_selfie,
    tanggal_masuk,
) VALUES (
    '$nik',
    '$nama_lengkap',
    '$email',
    '$no_hp',
    '$alamat',
    '$jenis_kelamin',
    '$tempat_lahir',
    '$tanggal_lahir',
    $id_jabatan,
    '$status',
    $id_departement,
    '$tanggal_masuk',
    '$photo_ktp',
    '$foto_selfie'
    '$tanggal_masuk'
)";


   if(mysqli_query($conn, $queri)){
        header("location: list.php");
        exit;

    }else{
        echo "gagal simpen: ". mysqli_error($conn);
    }



 }
?>

<form method="post"  enctype="multipart/form-data">
    Nama: <input type= "text" name="nama_lengkap" required placeholder="input nama lengkap"><br>
    email: <input type="email" name="email" required placeholder ="inputkan emailnya"><br>
    nik: <input type="number" name="nik" required placeholder ="inputkan niknya"><br>
    no_hp: <input type="number" name="no_hp" required placeholder ="inputkan no_hpnya"><br>
    alamat: <input type="text" name="alamat" required placeholder ="inputkan alamatnya"><br>
    <select name="jenis_kelamin">
        <option value = "P"> prempuan</option>
        <option value = "L"> cowok</option>
</select>
 <select name="status">
        <option value = "aktif"> aktif</option>
        <option value = "nonaktif"> nonaktif</option>
</select>

tempat_lahir: <input type="text" name="tempat_lahir" required placeholder ="inputkan tempat_lahirnya"><br>
    tanggal_lahir: <input type="date" name="tanggal_lahir" required placeholder ="inputkan tanggal_lahirnya"><br>
    photo_ktp: <input type="file" name="photo_ktp" required placeholder ="inputkan photo_ktpnya"><br>
    foto_selfie: <input type="file" name="foto_selfie" required placeholder ="inputkan foto_selfienya"><br>
    <select name="id_jabatan" >
 <option value=""> pilih jabatan </option>
 <?php 
 $q = mysqli_query($conn, "SELECT id_jabatan, nama_jabatan FROM jabatan");
 while ($j = mysqli_fetch_assoc($q)){
    echo "<option value='{$j['id_jabatan']}'>{$j['nama_jabatan']}</option>";
    }  ?>
</select>
<select name = "id_departement">
 <option value=""> pilih departement </option>
 <?php 
 $q = mysqli_query($conn, "SELECT id_departement, nama_departement FROM departement");
 while ($j = mysqli_fetch_assoc($q)){
    echo "<option value='{$j['id_departement']}'>{$j['nama_departement']}</option>";
    }  ?>
</select>
    tanggal_masuk : <input type="date" name="tanggal_masuk" required placeholder="inputkan tanggal masuknya"><br>
<button type="submit" name="simpan">simpan</button>
</form>


