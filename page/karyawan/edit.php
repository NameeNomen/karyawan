<?php
include "../../koneksi.php";

$id = $_GET['id_karyawan'];
$data = mysqli_query($conn, "SELECT * FROM karyawan WHERE id_karyawan=$id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
   echo "data gaada";
   exit;
}
if (isset($_POST['ubah'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $email = $_POST['email'];
    $photo_ktp =$_FILES['photo_ktp']['name'];
    $foto_selfie=$_FILES['foto_selfie']['name'];
    $tanggal_masuk =$_POST['tanggal_masuk'];
    $id_jabatan = $_POST['id_jabatan'];
    $id_departement = $_POST['id_departement'];
    $status = $_POST['status'];

    $allowmime = ['image/jpg','image/png','image/jpeg','image/webp'];
     foreach (['photo_ktp','foto_selfie'] as $value) {
        $mime = mime_content_type($_FILES[$value]['tmp_name']);
        if (!in_array($mime, $allowmime)) {
            echo 'file bukan gambar';
            exit;
        }
     }
    move_uploaded_file($_FILES['photo_ktp']['tmp_nsme'], "upload/".$photo_ktp);
    move_uploaded_file($_FILES['foto_Selfie']['tmp_nsme'], "upload/".$foto_Selfie);

    

    mysqli_query ($conn , "UPDATE karyawan SET 
    nama_lengkap='$nama_lengkap',
    nik=$nik,
    no_hp=$no_hp,
    alamat='$alamat',
    jenis_kelamin='$jenis_kelamin',
    tempat_lahir='$tempat_lahir',
    tanggal_lahir='$tanggal_lahir',
    email='$email',
    photo_ktp='$photo_ktp',
    foto_selfie='$foto_selfie',
    tanggal_masuk ='$tanggal_masuk',
    status = '$status',
    id_jabatan = '$id_jabatan',
    id_departement ='$id_departement'
     WHERE id_karyawan=$id");
    header("Location: list.php");


 }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
    
    <!-- FONT POPPINS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Poppins"', 'sans-serif'] },
                    colors: {
                        emerald: { 50: '#f4fcf8', 100: '#e3f0e9', 200: '#c2e0d3', 500: '#10b981', 600: '#059669', 800: '#065f46', 900: '#022c22' }
                    }
                }
            }
        }
    </script>

    <style>
        .glass-card {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 20px 40px -5px rgba(16, 185, 129, 0.05);
        }
        /* Style untuk File Input */
        input[type="file"]::file-selector-button {
            margin-right: 16px;
            padding: 6px 16px;
            border: none;
            background-color: #ecfdf5;
            color: #047857;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 13px;
            transition: background .2s;
        }
        input[type="file"]::file-selector-button:hover {
            background-color: #d1fae5;
        }
    </style>
</head>
<body class="bg-[#f4fcf8] text-gray-800 min-h-screen relative selection:bg-emerald-200 selection:text-emerald-900 overflow-x-hidden">

    <!-- Background Ambience -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute top-[-10%] left-[-5%] w-[50%] h-[50%] bg-emerald-100/60 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-teal-100/60 rounded-full blur-[100px]"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 py-12">
        
        <!-- HEADER -->
        <div class="flex items-center gap-4 mb-8">
            <a href="list.php" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-emerald-100 text-emerald-600 hover:bg-emerald-50 transition-colors shadow-sm">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"></path><path d="M12 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-emerald-900">Edit Data Pegawai</h1>
                <p class="text-sm text-emerald-700/60">Perbarui informasi personal dan jabatan pegawai.</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="glass-card rounded-3xl p-8 md:p-10">
            <form method="post" enctype="multipart/form-data">
                
                <!-- Section: Informasi Pribadi -->
                <h3 class="text-sm font-bold text-emerald-800 uppercase tracking-wider mb-6 border-b border-emerald-100 pb-2">Informasi Pribadi</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="<?= $row['nama_lengkap']; ?>" 
                               class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700 placeholder-gray-300">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Email</label>
                        <input type="email" name="email" value="<?= $row['email']; ?>" 
                               class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700">
                    </div>

                    <!-- NIK -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">NIK</label>
                        <input type="text" name="nik" value="<?= $row['nik']; ?>" 
                               class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700 font-mono">
                    </div>

                    <!-- No HP -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">No. Handphone</label>
                        <input type="text" name="no_hp" value="<?= $row['no_hp']; ?>" 
                               class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700">
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="<?= $row['tempat_lahir']; ?>" 
                               class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="<?= $row['tanggal_lahir']; ?>" 
                               class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Jenis Kelamin</label>
                        <div class="relative">
                            <select name="jenis_kelamin" class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700 appearance-none">
                                <option value="L" <?= ($row['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                                <option value="P" <?= ($row['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                            <!-- Chevron Icon -->
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat (Full Width) -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700"><?= $row['alamat']; ?></textarea>
                    </div>
                </div>

                <!-- Section: Kepegawaian -->
                <h3 class="text-sm font-bold text-emerald-800 uppercase tracking-wider mb-6 border-b border-emerald-100 pb-2 pt-4">Data Kepegawaian</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Departemen -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Departemen / Divisi</label>
                        <div class="relative">
                            <select name="id_departement" class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700 appearance-none">
                                <?php
                                $q = mysqli_query($conn, "SELECT id_departement, nama_departement FROM departement");
                                while ($d = mysqli_fetch_assoc($q)) {
                                    $selected = ($d['id_departement'] == $row['id_departement']) ? 'selected' : '';
                                    echo "<option value='{$d['id_departement']}' $selected>{$d['nama_departement']}</option>";
                                }
                                ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Jabatan</label>
                        <div class="relative">
                            <select name="id_jabatan" class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700 appearance-none">
                                <?php
                                $q = mysqli_query($conn, "SELECT id_jabatan, nama_jabatan FROM jabatan");
                                while ($j = mysqli_fetch_assoc($q)) {
                                    $selected = ($j['id_jabatan'] == $row['id_jabatan']) ? 'selected' : '';
                                    echo "<option value='{$j['id_jabatan']}' $selected>{$j['nama_jabatan']}</option>";
                                }
                                ?>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-2 uppercase tracking-wide">Status Pegawai</label>
                        <div class="relative">
                            <select name="status" class="w-full px-4 py-3 rounded-xl bg-white border border-emerald-100 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm font-medium text-gray-700 appearance-none">
                                <option value="aktif" <?= ($row['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                                <option value="nonaktif" <?= ($row['status'] == 'nonaktif') ? 'selected' : ''; ?>>Non-Aktif</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Dokumen Foto -->
                <h3 class="text-sm font-bold text-emerald-800 uppercase tracking-wider mb-6 border-b border-emerald-100 pb-2 pt-4">Dokumen Foto</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <!-- Foto KTP -->
                    <div class="bg-white p-4 rounded-xl border border-emerald-50">
                        <label class="block text-xs font-semibold text-gray-500 mb-3 uppercase tracking-wide">Foto KTP</label>
                        <input type="file" name="photo_ktp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all"/>
                        <?php if(!empty($row['photo_ktp'])): ?>
                            <p class="text-xs text-gray-400 mt-2 italic">File saat ini: <?= $row['photo_ktp']; ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Foto Selfie -->
                    <div class="bg-white p-4 rounded-xl border border-emerald-50">
                        <label class="block text-xs font-semibold text-gray-500 mb-3 uppercase tracking-wide">Foto Selfie / Profil</label>
                        <input type="file" name="foto_selfie" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all"/>
                        <?php if(!empty($row['foto_selfie'])): ?>
                            <p class="text-xs text-gray-400 mt-2 italic">File saat ini: <?= $row['foto_selfie']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end gap-4">
                    <a href="list.php" class="px-6 py-3 rounded-xl border border-gray-200 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition-all">
                        Batal
                    </a>
                    <button type="submit" name="ubah" class="px-8 py-3 rounded-xl bg-emerald-500 text-white font-bold text-sm shadow-lg shadow-emerald-500/30 hover:bg-emerald-600 hover:scale-[1.02] transition-all">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>