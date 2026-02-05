<?php
include "../../koneksi.php";
include "controller/listController.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Pegawai - Professional Pastel</title>
    
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
        /* Halus scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #C8E6C9; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #2E7D32; }
        
        .card-shadow {
            box-shadow: 0 4px 15px rgba(46,125,50,0.05);
        }
        .card-shadow:hover {
            box-shadow: 0 6px 20px rgba(46,125,50,0.12);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-pastel-bg text-gray-700 min-h-screen font-sans">

    <!-- Header Section -->
    <nav class="bg-white border-b border-pastel-border sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 md:h-20">
                <div class="flex items-center gap-4 md:gap-8">
                    <div>
                        <h1 class="text-lg md:text-xl font-extrabold text-pastel-dark tracking-tight uppercase">Data Pegawai</h1>
                        <p class="hidden md:block text-[10px] text-pastel-text font-semibold">Direktori Karyawan & Identitas</p>
                    </div>
                    
                    <!-- Search Bar Integrated -->
                    <form action="" method="get" class="hidden sm:block">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-3.5 w-3.5 text-pastel-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                            <input type="text" name="search" placeholder="Cari..." 
                                   class="block w-40 md:w-64 pl-9 pr-3 py-1.5 border-2 border-pastel-border rounded-full leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pastel-accent focus:border-transparent text-xs transition-all">
                        </div>
                    </form>
                </div>

                <div class="flex items-center gap-2 md:gap-3">
                    <a href="../../dashboard.php" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-pastel-dark hover:text-green-800 transition-colors rounded-full border border-transparent hover:border-pastel-border">
                        Kembali
                    </a>
                    <a href="registrasi.php" class="inline-flex items-center px-4 py-1.5 bg-pastel-dark rounded-full font-bold text-[11px] text-white shadow-md hover:bg-green-900 transition-all">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                        Tambah
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 pb-20">
            
            <?php 
            if (isset($hasil) && mysqli_num_rows($hasil) > 0) {
                while ($row = mysqli_fetch_assoc($hasil)) { 
                    $foto = !empty($row['foto_selfie']) ? $row['foto_selfie'] : 'default.png';
                    $ktp = !empty($row['photo_ktp']) ? $row['photo_ktp'] : '';
                    $nama = htmlspecialchars($row['nama_lengkap']);
                    $status = !empty($row['status']) ? $row['status'] : 'aktif';
                    $employeeData = json_encode($row);
            ?>
                <!-- Ultra Compact Card -->
                <div class="bg-white rounded-xl border border-pastel-border card-shadow transition-all duration-300 overflow-hidden flex flex-col group">
                    
                    <!-- Area Foto & Status Overlay -->
                    <div class="relative h-32 sm:h-36 overflow-hidden bg-green-50">
                        <img src="../../upload/<?= $foto; ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                             alt="<?= $nama; ?>"
                             onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($nama); ?>&background=C8E6C9&color=1B5E20&size=200'">
                        
                        <div class="absolute top-2 left-2">
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-md text-[8px] font-extrabold uppercase tracking-tighter shadow-sm border border-opacity-10 backdrop-blur-md
                                <?= $status == 'aktif' ? 'bg-white/90 text-green-700 border-green-600' : 'bg-white/90 text-red-700 border-red-600'; ?>">
                                <?= $status; ?>
                            </span>
                        </div>
                    </div>

                    <!-- Info Konten -->
                    <div class="p-3 flex flex-col flex-grow">
                        <div class="mb-2">
                            <!-- Nama Lengkap di paling depan/atas -->
                            <h3 class="text-[10px] font-extrabold text-pastel-dark truncate leading-tight uppercase mb-1" title="<?= $nama; ?>">
                                <?= $nama; ?>
                            </h3>
                            
                            <!-- Divisi (Kiri) & Jabatan (Kanan) -->
                            <div class="flex justify-between items-center gap-1">
                                <p class="text-[8px] text-pastel-text font-bold truncate tracking-tight" title="<?= !empty($row['nama_departement']) ? $row['nama_departement'] : '-'; ?>">
                                    <?= !empty($row['nama_departement']) ? $row['nama_departement'] : '-'; ?>
                                </p>
                                <p class="text-[8px] text-pastel-dark font-extrabold truncate tracking-tight text-right" title="<?= !empty($row['nama_jabatan']) ? $row['nama_jabatan'] : '-'; ?>">
                                    <?= !empty($row['nama_jabatan']) ? $row['nama_jabatan'] : '-'; ?>
                                </p>
                            </div>
                        </div>

                        <!-- Mini Actions (Termasuk Lihat KTP) -->
                        <div class="mt-auto flex items-center justify-center gap-1.5 pt-2 border-t border-pastel-border/20">
                            <!-- Tombol Lihat KTP -->
                            <?php if($ktp): ?>
                                <button onclick="showKtpModal('../../upload/<?= $ktp; ?>', '<?= addslashes($nama); ?>')" 
                                        class="p-1 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-full transition-all" title="Lihat KTP">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M3 4h18a2 2 0 012 2v12a2 2 0 01-2 2H3a2 2 0 01-2-2V6a2 2 0 012-2z"/><circle cx="9" cy="10" r="2"/><path d="M15 13h4"/></svg>
                                </button>
                            <?php endif; ?>

                            <!-- Tombol Info Detail -->
                            <button onclick='showEmployeeDetail(<?= htmlspecialchars($employeeData, ENT_QUOTES, 'UTF-8'); ?>)' 
                                    class="p-1 text-pastel-text hover:text-pastel-dark hover:bg-green-50 rounded-full transition-all" title="Info Lengkap">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                            </button>

                            <!-- Tombol Edit -->
                            <a href="edit.php?id_karyawan=<?= $row['id_karyawan']; ?>" class="p-1 text-amber-500 hover:text-amber-700 rounded-full transition-colors" title="Edit">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>

                            <!-- Tombol Hapus -->
                            <a href="hapus.php?id_karyawan=<?= $row['id_karyawan']; ?>" onclick="return confirm('Yakin ingin menghapus?')" class="p-1 text-red-400 hover:text-red-600 rounded-full transition-colors" title="Hapus">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php 
                } 
            } else {
                echo '<div class="col-span-full flex flex-col items-center justify-center py-20 bg-white rounded-2xl border-2 border-dashed border-pastel-border text-pastel-text/30">
                        <p class="text-xs font-bold uppercase tracking-widest">Data tidak ditemukan</p>
                      </div>';
            } 
            ?>
        </div>
    </div>

    <!-- Modal Detail Lengkap Pegawai -->
    <div id="detailModal" class="fixed inset-0 z-[110] hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-green-900/40 backdrop-blur-sm transition-opacity opacity-0 modal-backdrop"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative transform overflow-hidden rounded-3xl bg-white shadow-2xl transition-all w-full max-w-2xl opacity-0 translate-y-8 modal-panel border-4 border-white">
                    <div class="header-pattern px-6 py-5 border-b border-pastel-border flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-extrabold text-pastel-dark tracking-tight uppercase">Detail Informasi</h3>
                            <p class="text-[9px] text-pastel-text font-bold uppercase tracking-widest mt-0.5">Data Karyawan Terverifikasi</p>
                        </div>
                        <button onclick="closeDetailModal()" class="w-8 h-8 flex items-center justify-center text-pastel-dark hover:text-red-500 hover:bg-white rounded-full transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="p-6 md:p-8">
                        <div class="flex flex-col md:flex-row gap-8">
                            <div class="w-full md:w-1/3 flex flex-col items-center">
                                <div class="w-40 h-40 rounded-2xl overflow-hidden border-4 border-pastel-border shadow-md bg-green-50">
                                    <img id="detailFoto" src="" class="w-full h-full object-cover" alt="Foto">
                                </div>
                                <div id="detailBadgeStatus" class="mt-4 px-4 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest border-2"></div>
                            </div>
                            <div class="w-full md:w-2/3 space-y-4">
                                <div>
                                    <h4 id="detailNama" class="text-xl font-extrabold text-pastel-dark leading-tight"></h4>
                                    <p id="detailEmail" class="text-xs text-pastel-text font-bold mt-1"></p>
                                </div>
                                <div class="grid grid-cols-2 gap-2.5">
                                    <div class="p-2.5 bg-green-50/50 rounded-xl border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-1">NIK</p><p id="infoNik" class="text-xs font-mono font-bold text-pastel-dark"></p></div>
                                    <div class="p-2.5 bg-green-50/50 rounded-xl border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-1">Gender</p><p id="infoGender" class="text-xs font-bold text-pastel-dark"></p></div>
                                    <div class="p-2.5 bg-green-50/50 rounded-xl border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-1">Jabatan</p><p id="infoJabatan" class="text-xs font-bold text-pastel-dark"></p></div>
                                    <div class="p-2.5 bg-green-50/50 rounded-xl border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-1">Divisi</p><p id="infoDepartement" class="text-xs font-bold text-pastel-dark"></p></div>
                                    <div class="col-span-2 p-2.5 bg-green-50/50 rounded-xl border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-1">TTL</p><p id="infoTTL" class="text-xs font-bold text-pastel-dark"></p></div>
                                    <div class="p-2.5 bg-green-50/50 rounded-xl border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-1">Tgl Masuk</p><p id="infoTglMasuk" class="text-xs font-bold text-pastel-dark"></p></div>
                                    <div class="p-2.5 bg-green-50/50 rounded-xl border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-1">No. HP</p><p id="infoNoHp" class="text-xs font-bold text-pastel-dark"></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-white border-t border-pastel-border/30 flex justify-end gap-2">
                        <button onclick="closeDetailModal()" class="px-5 py-2 text-[10px] font-extrabold text-pastel-text border-2 border-pastel-border rounded-full hover:bg-green-50 transition-all">Tutup</button>
                        <a id="btnEditDetail" href="detail.php" class="px-5 py-2 text-[10px] font-extrabold text-white bg-pastel-dark rounded-full shadow-md hover:scale-105 transition-all">cetak card</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal KTP -->
    <div id="ktpModal" class="fixed inset-0 z-[120] hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-green-900/40 backdrop-blur-sm transition-opacity opacity-0" id="ktpBackdrop"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all w-full max-w-lg opacity-0 translate-y-4 scale-95" id="ktpPanel">
                    <div class="px-6 py-4 border-b border-pastel-border flex justify-between items-center bg-green-50/50">
                        <h3 class="text-[10px] font-extrabold text-pastel-dark uppercase tracking-widest" id="ktpTitle">Berkas Identitas (KTP)</h3>
                        <button onclick="closeKtpModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="p-4 bg-gray-50 flex justify-center">
                        <img id="ktpImage" src="" alt="KTP" class="max-h-[50vh] w-auto rounded-lg shadow-sm border border-pastel-border">
                    </div>
                    <div class="px-4 py-3 bg-white border-t border-pastel-border/30 flex justify-end gap-2">
                        <button onclick="closeKtpModal()" class="px-4 py-1.5 text-[10px] font-bold text-gray-500 rounded-full">Batal</button>
                        <a id="ktpDownload" href="#" download class="px-4 py-1.5 text-[10px] font-bold text-white bg-pastel-dark rounded-full shadow-sm">Unduh</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const detailModal = document.getElementById('detailModal');
        const detailBackdrop = detailModal.querySelector('.modal-backdrop');
        const detailPanel = detailModal.querySelector('.modal-panel');

        function showEmployeeDetail(data) {
            document.getElementById('detailNama').textContent = data.nama_lengkap || '-';
            document.getElementById('detailEmail').textContent = data.email || '-';
            document.getElementById('infoNik').textContent = data.nik || '-';
            document.getElementById('infoJabatan').textContent = data.nama_jabatan || '-';
            document.getElementById('infoDepartement').textContent = data.nama_departement || '-';
            document.getElementById('infoNoHp').textContent = data.no_hp || '-';
            document.getElementById('infoGender').textContent = (data.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
            const tglLahir = data.tanggal_lahir ? new Date(data.tanggal_lahir).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';
            document.getElementById('infoTTL').textContent = `${data.tempat_lahir || '-'}, ${tglLahir}`;
            document.getElementById('infoTglMasuk').textContent = data.tanggal_masuk ? new Date(data.tanggal_masuk).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';
            const fotoPath = data.foto_selfie ? `../../upload/${data.foto_selfie}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(data.nama_lengkap)}&background=C8E6C9&color=1B5E20&size=200`;
            document.getElementById('detailFoto').src = fotoPath;
            const id_karyawan = (data.id_karyawan);
            // const status = (data.status || 'aktif').toLowerCase();
            const badge = document.getElementById('detailBadgeStatus');
            badge.textContent = status;
            badge.className = status === 'aktif' ? 'mt-4 px-4 py-1 rounded-full text-[9px] font-extrabold uppercase tracking-widest border-2 bg-green-50 text-green-700 border-green-300' : 'mt-4 px-4 py-1 rounded-full text-[9px] font-extrabold uppercase tracking-widest border-2 bg-red-50 text-red-700 border-red-300';
            document.getElementById('btnEditDetail').href = `detail.php?id_karyawan=${data.id_karyawan}`;
            detailModal.classList.remove('hidden');
            setTimeout(() => {
                detailBackdrop.classList.replace('opacity-0', 'opacity-100');
                detailPanel.classList.replace('opacity-0', 'opacity-100');
                detailPanel.classList.remove('translate-y-8');
            }, 20);
        }

        function closeDetailModal() {
            detailBackdrop.classList.replace('opacity-100', 'opacity-0');
            detailPanel.classList.replace('opacity-100', 'opacity-0');
            detailPanel.classList.add('translate-y-8');
            setTimeout(() => detailModal.classList.add('hidden'), 300);
        }

        const ktpModal = document.getElementById('ktpModal');
        const ktpBackdrop = document.getElementById('ktpBackdrop');
        const ktpPanel = document.getElementById('ktpPanel');

        function showKtpModal(src, name) {
            document.getElementById('ktpImage').src = src;
            document.getElementById('ktpTitle').textContent = 'KTP: ' + name;
            document.getElementById('ktpDownload').href = src;
            ktpModal.classList.remove('hidden');
            setTimeout(() => {
                ktpBackdrop.classList.replace('opacity-0', 'opacity-100');
                ktpPanel.classList.replace('opacity-0', 'opacity-100');
                ktpPanel.classList.remove('translate-y-4', 'scale-95');
            }, 20);
        }

        function closeKtpModal() {
            ktpBackdrop.classList.replace('opacity-100', 'opacity-0');
            ktpPanel.classList.replace('opacity-100', 'opacity-0');
            ktpPanel.classList.add('translate-y-4', 'scale-95');
            setTimeout(() => ktpModal.classList.add('hidden'), 300);
        }

        window.onclick = (e) => {
            if (e.target === detailModal.querySelector('.flex')) closeDetailModal();
            if (e.target === ktpModal.querySelector('.flex')) closeKtpModal();
        }
        document.addEventListener('keydown', (e) => {
            if (e.key === "Escape") { closeDetailModal(); closeKtpModal(); }
        });
    </script>
</body>
</html>