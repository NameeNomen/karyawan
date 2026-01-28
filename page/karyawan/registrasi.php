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
    foto_selfie
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
)";


   if(mysqli_query($conn, $queri)){
        header("location: list.php");
        exit;

    }else{
        echo "gagal simpen: ". mysqli_error($conn);
    }



 }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Karyawan - Pastel</title>
    <!-- Font Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Reset Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #E8F5E9; /* Background Halaman Pastel Hijau */
            padding: 40px 20px;
            color: #2E7D32; /* Teks Hijau Gelap */
        }

        /* Container Utama */
        .form-container {
            max-width: 850px;
            margin: 0 auto;
            background: #ffffff; /* Container Putih Bersih */
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(46, 125, 50, 0.1); /* Shadow Hijau Halus */
            border: 1px solid #C8E6C9;
        }

        /* --- HEADER DENGAN POLA AESTETIK FORMAL --- */
        .form-header {
            /* Background Pastel Hijau Sedikit Lebih Gelap */
            background-color: #C8E6C9; 
            color: #1B5E20; /* Teks Hijau Sangat Tua */
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Membuat Pola Geometris (Pola Kotak-kotak Halus / Grid Pattern) */
        .form-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.3) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.3) 1px, transparent 1px);
            background-size: 20px 20px; /* Ukuran kotak pola */
            opacity: 0.6;
            z-index: 1;
        }

        /* Dekorasi Lingkaran Abstrak untuk Kesan Estetik */
        .form-header::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%);
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2; /* Agar teks di atas pola */
        }

        .form-header h2 {
            margin: 0;
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 800; /* Teks Lebih Tebal Sesuai Request */
        }

        .form-header p {
            margin-top: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            opacity: 0.8;
        }

        /* Layout Grid Form */
        form {
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr; /* 2 Kolom */
            gap: 25px;
        }

        .full-width {
            grid-column: span 2;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        /* Label Teks Tebal */
        label {
            margin-bottom: 8px;
            font-weight: 700; /* Label Tebal */
            color: #1B5E20; /* Hijau Tua Kontras */
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Styling Input */
        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #E8F5E9; /* Border Pastel */
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 500;
            background-color: #FAFAFA;
            color: #333;
            transition: all 0.3s ease;
        }

        /* Efek Fokus */
        input:focus, select:focus, textarea:focus {
            border-color: #66BB6A; /* Hijau Cerah saat fokus */
            background-color: #fff;
            outline: none;
            box-shadow: 0 4px 10px rgba(102, 187, 106, 0.15);
        }

        /* Styling Input File Custom */
        input[type="file"] {
            padding: 10px;
            background: #F1F8E9;
            border: 2px dashed #81C784;
            cursor: pointer;
        }
        
        input[type="file"]:hover {
            background: #E8F5E9;
            border-color: #4CAF50;
        }

        /* Tombol Simpan */
        .btn-submit {
            grid-column: span 2;
            background-color: #2E7D32; /* Tombol Hijau Tua */
            color: white;
            border: none;
            padding: 18px;
            font-size: 1.1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 15px rgba(46, 125, 50, 0.2);
        }

        .btn-submit:hover {
            background-color: #1B5E20;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 125, 50, 0.3);
        }

        /* Responsif */
        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
                padding: 25px;
            }
            .full-width {
                grid-column: span 1;
            }
            .form-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="form-header">
        <div class="header-content">
            <h2>Input Data Karyawan</h2>
            <p>Lengkapi Data Diri dengan Valid</p>
        </div>
    </div>

    <form method="post" enctype="multipart/form-data">
        
        <!-- Baris 1: Nama -->
        <div class="form-group full-width">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" required placeholder="Input nama lengkap">
        </div>

        <!-- Baris 2: Email & No HP -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Inputkan emailnya">
        </div>

        <div class="form-group">
            <label>No. HP</label>
            <input type="number" name="no_hp" required placeholder="Inputkan no_hpnya">
        </div>

        <!-- Baris 3: NIK & Status -->
        <div class="form-group">
            <label>NIK</label>
            <input type="number" name="nik" required placeholder="Inputkan niknya">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        <!-- Baris 4: TTL -->
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" required placeholder="Inputkan tempat lahir">
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" required>
        </div>

        <!-- Baris 5: Gender -->
        <div class="form-group full-width">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin">
                <option value="L">Laki-laki (Cowok)</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <!-- Baris 6: Alamat -->
        <div class="form-group full-width">
            <label>Alamat</label>
            <textarea name="alamat" rows="3" required placeholder="Inputkan alamatnya"></textarea>
        </div>

        <!-- Baris 7: Jabatan & Departemen -->
        <div class="form-group">
            <label>Jabatan</label>
            <select name="id_jabatan" required>
                <option value="">Pilih Jabatan</option>
                <?php 
                if(isset($conn)){
                    $q = mysqli_query($conn, "SELECT id_jabatan, nama_jabatan FROM jabatan");
                    while ($j = mysqli_fetch_assoc($q)){
                        echo "<option value='{$j['id_jabatan']}'>{$j['nama_jabatan']}</option>";
                    } 
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Departemen</label>
            <select name="id_departement" required>
                <option value="">Pilih Departemen</option>
                <?php 
                if(isset($conn)){
                    $q = mysqli_query($conn, "SELECT id_departement, nama_departement FROM departement");
                    while ($j = mysqli_fetch_assoc($q)){
                        echo "<option value='{$j['id_departement']}'>{$j['nama_departement']}</option>";
                    } 
                }
                ?>
            </select>
        </div>

        <!-- Baris 8: Tanggal Masuk -->
        <div class="form-group full-width">
            <label>Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" required>
        </div>

        <!-- Baris 9: Upload Foto -->
        <div class="form-group">
            <label><i class="fas fa-id-card"></i> Photo KTP</label>
            <input type="file" name="photo_ktp" required>
        </div>

        <div class="form-group">
            <label><i class="fas fa-camera"></i> Foto Selfie</label>
            <input type="file" name="foto_selfie" required>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" name="simpan" class="btn-submit">
            <i class="fas fa-save"></i> Simpan
        </button>

    </form>
</div>

</body>
</html>