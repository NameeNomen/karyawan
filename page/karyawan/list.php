

<?php
include "../../koneksi.php";
include "controller/listController.php";
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Pegawai - Pastel</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Montserrat"', 'sans-serif'] },
                    colors: {
                        pastel: { 
                            bg: '#E8F5E9', 
                            card: '#FFFFFF',
                            border: '#C8E6C9',
                            text: '#2E7D32',
                            dark: '#1B5E20',
                            accent: '#66BB6A'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .header-pattern {
            background-color: #C8E6C9;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.4) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.4) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #C8E6C9; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2E7D32; }
    </style>
</head>
<body class="bg-pastel-bg text-gray-700 min-h-screen font-sans">

    <div class="header-pattern border-b border-pastel-border shadow-sm mb-8">
        <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-pastel-dark tracking-wide uppercase">Data Pegawai</h1>
                <p class="text-pastel-text font-medium mt-1">Direktori Karyawan & Dokumen Identitas</p>
            </div>
            <div class="flex gap-3">
                <a href="../../dashboard.php" class="px-5 py-2.5 bg-white border-2 border-pastel-border text-pastel-dark font-bold rounded-full hover:bg-green-50 transition-all text-sm shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="registrasi.php" class="px-5 py-2.5 bg-pastel-dark text-white font-bold rounded-full hover:bg-green-900 transition-all shadow-md hover:shadow-lg text-sm flex items-center gap-2">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Pegawai
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-8 pb-10">
            
        <?php 
        if (isset($data) && mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_assoc($data)) { 
                $foto = !empty($row['foto_selfie']) ? $row['foto_selfie'] : 'default.png';
                $ktp = !empty($row['photo_ktp']) ? $row['photo_ktp'] : '';
                $nama = htmlspecialchars($row['nama_lengkap']);
                $status = !empty($row['status']) ? $row['status'] : 'aktif';
                
                $gender = '-';
                if (!empty($row['jenis_kelamin'])) {
                    $gender = ($row['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan';
                }
        ?>
            <div class="bg-white rounded-2xl border border-pastel-border shadow-[0_4px_20px_rgba(46,125,50,0.05)] hover:shadow-[0_8px_25px_rgba(46,125,50,0.15)] hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col sm:flex-row h-full group">
                
                <div class="w-full sm:w-48 h-64 sm:h-auto shrink-0 relative bg-green-50 flex items-center justify-center overflow-hidden border-r border-green-100">
                    <img src="../../upload/<?= $foto; ?>" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         alt="<?= $nama; ?>"
                         onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($nama); ?>&background=C8E6C9&color=1B5E20&size=200'">
                    
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-widest shadow-sm border border-opacity-20 backdrop-blur-sm
                            <?= $status == 'aktif' ? 'bg-white/90 text-green-700 border-green-600' : 'bg-white/90 text-red-700 border-red-600'; ?>">
                            <div class="w-1.5 h-1.5 rounded-full mr-1.5 <?= $status == 'aktif' ? 'bg-green-600' : 'bg-red-600'; ?>"></div>
                            <?= $status; ?>
                        </span>
                    </div>
                </div>

                <div class="p-5 flex flex-col flex-grow min-w-0 justify-between">
                    
                    <div class="mb-5 text-center sm:text-left">
                        <h3 class="text-lg font-extrabold text-pastel-dark truncate leading-tight tracking-tight" title="<?= $nama; ?>">
                            <?= $nama; ?>
                        </h3>
                        <div class="flex items-center justify-center sm:justify-start text-xs text-pastel-text font-medium truncate mt-1">
                            <svg class="w-3.5 h-3.5 mr-1.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <?= $row['email']; ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-sm mb-6">
                        
                        <div class="col-span-1 rounded-xl border border-pastel-border overflow-hidden group/box hover:shadow-sm transition-all bg-white">
                            <div class="bg-green-50/50 py-2 border-b border-pastel-border/50 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-green-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="text-[10px] font-bold text-green-700/70 uppercase tracking-wider">Jabatan</span>
                            </div>
                            <div class="py-2.5 px-2 text-center">
                                <p class="font-bold text-pastel-dark truncate" title="<?= $row['nama_jabatan']; ?>">
                                    <?= !empty($row['nama_jabatan']) ? $row['nama_jabatan'] : '-'; ?>
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-span-1 rounded-xl border border-pastel-border overflow-hidden group/box hover:shadow-sm transition-all bg-white">
                            <div class="bg-green-50/50 py-2 border-b border-pastel-border/50 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-green-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                <span class="text-[10px] font-bold text-green-700/70 uppercase tracking-wider">Divisi</span>
                            </div>
                            <div class="py-2.5 px-2 text-center">
                                <p class="font-bold text-pastel-dark truncate" title="<?= $row['nama_departement']; ?>">
                                    <?= !empty($row['nama_departement']) ? $row['nama_departement'] : '-'; ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-span-1 rounded-xl border border-pastel-border overflow-hidden group/box hover:shadow-sm transition-all bg-white">
                            <div class="bg-green-50/50 py-2 border-b border-pastel-border/50 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-green-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .6.4 1 1 1 2.3 0 2.7.3 2 1"></path></svg>
                                <span class="text-[10px] font-bold text-green-700/70 uppercase tracking-wider">NIK</span>
                            </div>
                            <div class="py-2.5 px-2 text-center">
                                <p class="font-bold text-pastel-dark font-mono text-xs truncate">
                                    <?= !empty($row['nik']) ? $row['nik'] : '-'; ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-span-1 rounded-xl border border-pastel-border overflow-hidden group/box hover:shadow-sm transition-all bg-white">
                            <div class="bg-green-50/50 py-2 border-b border-pastel-border/50 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-green-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span class="text-[10px] font-bold text-green-700/70 uppercase tracking-wider">No HP</span>
                            </div>
                            <div class="py-2.5 px-2 text-center">
                                <p class="font-bold text-pastel-dark truncate text-xs"><?= !empty($row['no_hp']) ? $row['no_hp'] : '-'; ?></p>
                            </div>
                        </div>

                        <div class="col-span-1 rounded-xl border border-pastel-border overflow-hidden group/box hover:shadow-sm transition-all bg-white">
                            <div class="bg-green-50/50 py-2 border-b border-pastel-border/50 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-green-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-[10px] font-bold text-green-700/70 uppercase tracking-wider">Lahir Di</span>
                            </div>
                            <div class="py-2.5 px-2 text-center">
                                <p class="font-bold text-pastel-dark truncate text-xs"><?= !empty($row['tempat_lahir']) ? $row['tempat_lahir'] : '-'; ?></p>
                            </div>
                        </div>

                        <div class="col-span-1 rounded-xl border border-pastel-border overflow-hidden group/box hover:shadow-sm transition-all bg-white">
                            <div class="bg-green-50/50 py-2 border-b border-pastel-border/50 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-green-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path></svg>
                                <span class="text-[10px] font-bold text-green-700/70 uppercase tracking-wider">Tgl Lahir</span>
                            </div>
                            <div class="py-2.5 px-2 text-center">
                                <p class="font-bold text-pastel-dark truncate text-xs"><?= !empty($row['tanggal_lahir']) ? date('d M Y', strtotime($row['tanggal_lahir'])) : '-'; ?></p>
                            </div>
                        </div>

                        <div class="col-span-1 rounded-xl border border-pastel-border overflow-hidden group/box hover:shadow-sm transition-all bg-white">
                            <div class="bg-green-50/50 py-2 border-b border-pastel-border/50 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-green-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span class="text-[10px] font-bold text-green-700/70 uppercase tracking-wider">Gender</span>
                            </div>
                            <div class="py-2.5 px-2 text-center">
                                <p class="font-bold text-pastel-dark text-xs"><?= $gender; ?></p>
                            </div>
                        </div>

                        <div class="col-span-1 rounded-xl border border-pastel-border overflow-hidden group/box hover:shadow-sm transition-all bg-white">
                            <div class="bg-green-50/50 py-2 border-b border-pastel-border/50 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-green-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-[10px] font-bold text-green-700/70 uppercase tracking-wider">Tgl Masuk</span>
                            </div>
                            <div class="py-2.5 px-2 text-center">
                                <p class="font-bold text-pastel-dark truncate text-xs"><?= !empty($row['tanggal_masuk']) ? date('d M Y', strtotime($row['tanggal_masuk'])) : '-'; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto flex items-center justify-between gap-3 pt-3 border-t border-dashed border-green-100">
                        <?php if($ktp): ?>
                            <button onclick="showModal('../../upload/<?= $ktp; ?>', '<?= addslashes($nama); ?>')" 
                                    class="text-[11px] font-bold text-pastel-dark bg-green-50 hover:bg-green-100 border border-green-200 flex items-center gap-1.5 px-3 py-1.5 rounded-full transition-colors">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 4h18a2 2 0 012 2v12a2 2 0 01-2 2H3a2 2 0 01-2-2V6a2 2 0 012-2z"/><path d="M12 11h.01"/><path d="M7 15h10"/></svg>
                                Lihat KTP
                            </button>
                        <?php else: ?>
                            <span class="text-[10px] text-green-600/60 italic px-2 select-none">No KTP</span>
                        <?php endif; ?>

                        <div class="flex items-center gap-1">
                            <a href="detail.php?id_karyawan=<?= $row['id_karyawan']; ?>" class="w-8 h-8 flex items-center justify-center text-green-400 hover:text-pastel-dark hover:bg-green-50 rounded-full transition-all" title="Cetak Card">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                            </a>
                            <a href="edit.php?id_karyawan=<?= $row['id_karyawan']; ?>" class="w-8 h-8 flex items-center justify-center text-blue-400 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-all" title="Edit">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <a href="hapus.php?id_karyawan=<?= $row['id_karyawan']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="w-8 h-8 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 rounded-full transition-all" title="Hapus">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        <?php 
            } 
        } else {
             echo '<div class="col-span-full flex flex-col items-center justify-center py-20 text-gray-500 bg-white rounded-2xl border-2 border-dashed border-pastel-border">
                    <svg class="w-16 h-16 text-green-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <p class="font-medium text-lg">Belum ada data pegawai.</p>
                   </div>';
        } 
        ?>

    </div>

    <div id="ktpModal" class="fixed inset-0 z-[100] hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-green-900/40 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop"></div>
        
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all w-full max-w-2xl opacity-0 translate-y-4 scale-95 border-4 border-white" id="modalPanel">
                    
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-green-50">
                        <h3 class="text-lg font-bold text-pastel-dark flex items-center gap-2" id="modalTitle">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .6.4 1 1 1 2.3 0 2.7.3 2 1"/></svg>
                             Preview Identitas
                        </h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-red-500 focus:outline-none transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="p-8 bg-gray-50 flex justify-center">
                        <img id="modalImage" src="" alt="KTP" class="max-h-[60vh] w-auto rounded-lg shadow-lg border border-gray-200">
                    </div>

                    <div class="px-6 py-4 bg-white border-t border-gray-100 flex justify-end gap-3">
                        <button onclick="closeModal()" class="px-5 py-2.5 text-sm font-bold text-gray-600 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition-colors">Tutup</button>
                        <a id="downloadBtn" href="#" download class="px-5 py-2.5 text-sm font-bold text-white bg-pastel-dark rounded-full hover:bg-green-900 transition-colors shadow-lg shadow-green-900/20">Download Gambar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('ktpModal');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalPanel = document.getElementById('modalPanel');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const downloadBtn = document.getElementById('downloadBtn');

        function showModal(src, name) {
            modalImage.src = src;
            modalTitle.innerHTML = '<svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .6.4 1 1 1 2.3 0 2.7.3 2 1"/></svg> KTP: ' + name;
            downloadBtn.href = src;
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalBackdrop.classList.remove('opacity-0');
                modalPanel.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
            }, 20);
        }

        function closeModal() {
            modalBackdrop.classList.add('opacity-0');
            modalPanel.classList.add('opacity-0', 'translate-y-4', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                modalImage.src = '';
            }, 300);
        }

        modal.addEventListener('click', (e) => {
            if (e.target.closest('#modalPanel') === null) closeModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === "Escape") closeModal();
        });
    </script>
</body>
</html>