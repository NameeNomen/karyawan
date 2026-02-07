<?php
include "../../koneksi.php";
include "controller/editController.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Poppins"', 'sans-serif'] },
                    colors: {
                        // Custom Palette untuk konsistensi Pastel & Border Tua
                        pastel: {
                            bg: '#ecfdf5',      // Latar belakang halaman
                            card: '#fafffd',    // Latar belakang kartu (hampir putih)
                            input: '#ffffff',   // Latar input
                            border: '#6ee7b7',  // Border input normal (lebih tua dari input)
                            focus: '#059669',   // Border saat fokus (tua)
                            text: '#064e3b',    // Teks utama
                            label: '#047857'    // Teks label
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Pola Grid Estetik Formal */
        .bg-pattern {
            background-color: #f0fdf4; /* Emerald 50 */
            background-image: linear-gradient(#d1fae5 1px, transparent 1px), linear-gradient(90deg, #d1fae5 1px, transparent 1px);
            background-size: 24px 24px; /* Ukuran kotak grid */
        }

        /* Styling Input File Custom */
        input[type="file"]::file-selector-button {
            margin-right: 16px;
            padding: 8px 16px;
            border: 1px solid #34d399; /* Border lebih tua */
            background-color: #ecfdf5; /* Background pastel */
            color: #065f46;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 12px;
            transition: all .2s;
        }
        input[type="file"]::file-selector-button:hover {
            background-color: #d1fae5;
            border-color: #10b981;
        }
        
        /* Haluskan transisi input */
        .form-input {
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>
<body class="bg-pattern min-h-screen text-gray-800 font-sans selection:bg-emerald-200 selection:text-emerald-900 pb-12">

    <div class="max-w-4xl mx-auto px-6 pt-10">
        
        <div class="flex flex-col md:flex-row md:items-center gap-5 mb-8">
            <a href="list.php" class="group w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-emerald-300 text-emerald-600 hover:bg-emerald-600 hover:text-white hover:border-emerald-700 transition-all shadow-sm">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"></path><path d="M12 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-emerald-900 tracking-tight">Edit Data Pegawai</h1>
                <p class="text-sm text-emerald-600 font-medium mt-1">Formulir pembaruan data sistem kepegawaian.</p>
            </div>
        </div>

        <div class="bg-pastel-card rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-emerald-200 p-8 md:p-10 relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -z-10"></div>

            <form method="post" enctype="multipart/form-data">
                
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6 border-b border-emerald-100 pb-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        <h3 class="text-md font-bold text-emerald-800 uppercase tracking-wider">Informasi Pribadi</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                        <div class="col-span-1 md:col-span-1">
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="<?= $row['nama_lengkap']; ?>" 
                                   class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 placeholder-emerald-200 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Email</label>
                            <input type="email" name="email" value="<?= $row['email']; ?>" 
                                   class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Nomor Induk (NIK)</label>
                            <input type="text" name="nik" value="<?= $row['nik']; ?>" 
                                   class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 font-mono shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">No. Handphone</label>
                            <input type="text" name="no_hp" value="<?= $row['no_hp']; ?>" 
                                   class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="<?= $row['tempat_lahir']; ?>" 
                                   class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="<?= $row['tanggal_lahir']; ?>" 
                                   class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Jenis Kelamin</label>
                            <div class="relative">
                                <select name="jenis_kelamin" class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 appearance-none shadow-sm cursor-pointer">
                                    <option value="L" <?= ($row['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                                    <option value="P" <?= ($row['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-emerald-500">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Alamat Lengkap</label>
                            <textarea name="alamat" rows="2" class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 shadow-sm resize-none"><?= $row['alamat']; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6 border-b border-emerald-100 pb-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                        </div>
                        <h3 class="text-md font-bold text-emerald-800 uppercase tracking-wider">Data Kepegawaian</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                        <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Departemen</label>
                            <div class="relative">
                                <select name="id_departement" class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 appearance-none shadow-sm cursor-pointer">
                                    <?php
                                    $q = mysqli_query($conn, "SELECT id_departement, nama_departement FROM departement");
                                    while ($d = mysqli_fetch_assoc($q)) {
                                        $selected = ($d['id_departement'] == $row['id_departement']) ? 'selected' : '';
                                        echo "<option value='{$d['id_departement']}' $selected>{$d['nama_departement']}</option>";
                                    }
                                    ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-emerald-500">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Jabatan</label>
                            <div class="relative">
                                <select name="id_jabatan" class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 appearance-none shadow-sm cursor-pointer">
                                    <?php
                                    $q = mysqli_query($conn, "SELECT id_jabatan, nama_jabatan FROM jabatan");
                                    while ($j = mysqli_fetch_assoc($q)) {
                                        $selected = ($j['id_jabatan'] == $row['id_jabatan']) ? 'selected' : '';
                                        echo "<option value='{$j['id_jabatan']}' $selected>{$j['nama_jabatan']}</option>";
                                    }
                                    ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-emerald-500">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Status</label>
                            <div class="relative">
                                <select name="status" class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 appearance-none shadow-sm cursor-pointer">
                                    <option value="aktif" <?= ($row['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="nonaktif" <?= ($row['status'] == 'nonaktif') ? 'selected' : ''; ?>>Non-Aktif</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-emerald-500">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                                </div>
                            </div>
                        </div>
                        
                         <div>
                            <label class="block text-xs font-bold text-pastel-label mb-2 uppercase">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" value="<?= $row['tanggal_masuk']; ?>" 
                                   class="form-input w-full px-4 py-3 rounded-lg bg-white border border-emerald-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-sm font-medium text-emerald-950 shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-6 border-b border-emerald-100 pb-3">
                         <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <h3 class="text-md font-bold text-emerald-800 uppercase tracking-wider">Dokumen Pendukung</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 rounded-xl border border-emerald-200 bg-white shadow-sm hover:border-emerald-400 transition-colors">
                            <label class="block text-xs font-bold text-pastel-label mb-3 uppercase flex justify-between">
                                <span>Scan KTP</span>
                                <?php if(!empty($row['photo_ktp'])): ?>
                                    <span class="text-emerald-500 font-normal normal-case text-[10px] bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">File ada</span>
                                <?php endif; ?>
                            </label>
                            <input type="file" name="photo_ktp" class="block w-full text-sm text-gray-500"/>
                             <?php if(!empty($row['photo_ktp'])): ?>
                                <p class="text-[11px] text-gray-400 mt-2 truncate">Current: <?= $row['photo_ktp']; ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="p-4 rounded-xl border border-emerald-200 bg-white shadow-sm hover:border-emerald-400 transition-colors">
                            <label class="block text-xs font-bold text-pastel-label mb-3 uppercase flex justify-between">
                                <span>Foto Profil</span>
                                <?php if(!empty($row['foto_selfie'])): ?>
                                    <span class="text-emerald-500 font-normal normal-case text-[10px] bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">File ada</span>
                                <?php endif; ?>
                            </label>
                            <input type="file" name="foto_selfie" class="block w-full text-sm text-gray-500"/>
                            <?php if(!empty($row['foto_selfie'])): ?>
                                <p class="text-[11px] text-gray-400 mt-2 truncate">Current: <?= $row['foto_selfie']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-emerald-100">
                    <a href="list.php" class="px-6 py-2.5 rounded-lg border-2 border-emerald-200 text-emerald-700 font-semibold text-sm hover:bg-emerald-50 hover:border-emerald-300 transition-all">
                        Batalkan
                    </a>
                    <button type="submit" name="ubah" class="px-8 py-2.5 rounded-lg bg-emerald-600 text-white font-bold text-sm shadow-lg shadow-emerald-200 hover:bg-emerald-700 hover:shadow-emerald-300 transform hover:-translate-y-0.5 transition-all">
                        Simpan Data
                    </button>
                </div>

            </form>
        </div>
        
        <div class="text-center mt-8 text-emerald-800/40 text-xs font-mono">
            Sistem Kepegawaian v2.0 &bull; Secure Form
        </div>
    </div>

</body>
</html>