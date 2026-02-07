<?php
include "../../koneksi.php";
include "controller/listController.php"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Pegawai - Green Leaf</title>
    
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
                        pastel: { 
                            bg: '#F1F8E9',       // Hijau Mint
                            card: '#FFFFFF',     // Putih
                            border: '#A5D6A7',   // Sage
                            primary: '#43A047',  // Hijau Daun
                            hover: '#2E7D32',    // Hijau Tua
                            text: '#1B5E20',     // Teks Gelap
                            muted: '#81C784'     // Pudar
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* HEADER PATTERN */
        .header-pattern {
            background-color: #C8E6C9; 
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.5) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.5) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #A5D6A7; border-radius: 10px; }

        /* Card Hover */
        .card-active:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(67, 160, 71, 0.25);
            border-color: #43A047;
        }

        /* Card Non-Aktif */
        .card-disabled {
            filter: grayscale(100%);
            opacity: 0.75;
            background-color: #FAFAFA;
            transition: all 0.2s ease;
        }
        .card-disabled:hover {
            opacity: 1; 
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-pastel-bg text-gray-700 min-h-screen font-sans pb-24">

    <div class="header-pattern border-b border-pastel-border shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center">
            <div class="flex items-center gap-4">
                <svg class="w-10 h-10 text-pastel-text drop-shadow-sm" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17,8C8,10,5.9,16.17,3.82,21.34L5.71,22l1-2.3A4.49,4.49,0,0,0,8,20C19,20,22,3,22,3,21,5,14,5.25,9,6.25S2,11.5,2,13.5a6.22,6.22,0,0,0,1.75,4.91l.12.13L4,20.9C5.6,15.23,17,8,17,8Z"/>
                </svg>
                <div>
                    <h1 class="text-2xl font-bold text-pastel-text tracking-wide uppercase leading-none">Data Karyawan</h1>
                    <p class="text-[11px] text-pastel-primary font-semibold tracking-widest mt-0.5">Direktori Pegawai</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8 bg-white p-2 rounded-xl border border-pastel-border shadow-sm">
            <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto items-center">
                <a href="registrasi.php" class="flex items-center justify-center gap-2 px-5 py-2.5 bg-pastel-primary hover:bg-pastel-hover text-white text-xs font-bold uppercase tracking-wider rounded-lg transition-colors shadow-md w-full md:w-auto whitespace-nowrap">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah
                </a>
                <form action="" method="get" class="w-full md:w-64">
                    <input type="hidden" name="status" value="<?= $statusFilter ?>">
                    <div class="relative group">
                        <input type="text" name="search" value="<?= htmlspecialchars($cari) ?>" placeholder="Cari data..." 
                               class="w-full pl-9 pr-4 py-2.5 bg-pastel-bg border border-pastel-border focus:border-pastel-primary focus:bg-white rounded-lg text-xs font-semibold text-pastel-text focus:outline-none transition-all placeholder-gray-400 group-hover:bg-white">
                        <svg class="w-4 h-4 absolute left-3 top-2.5 text-gray-400 group-hover:text-pastel-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </form>
            </div>
            <div class="flex bg-pastel-bg p-1 rounded-lg w-full md:w-auto border border-pastel-border justify-center">
                <a href="?status=aktif" class="flex-1 md:flex-none px-5 py-2 rounded-md text-[10px] font-bold uppercase tracking-wider transition-all text-center whitespace-nowrap <?= $statusFilter == 'aktif' ? 'bg-white text-pastel-primary shadow-sm border border-pastel-border' : 'text-gray-500 hover:text-pastel-text'; ?>">
                    Aktif <span class="ml-1 opacity-70 bg-green-100 px-1.5 rounded-full text-green-800"><?= $countAktif ?></span>
                </a>
                <a href="?status=nonaktif" class="flex-1 md:flex-none px-5 py-2 rounded-md text-[10px] font-bold uppercase tracking-wider transition-all text-center whitespace-nowrap <?= $statusFilter == 'nonaktif' ? 'bg-white text-gray-600 shadow-sm border border-gray-200' : 'text-gray-500 hover:text-pastel-text'; ?>">
                    Non-Aktif <span class="ml-1 opacity-70 bg-gray-200 px-1.5 rounded-full text-gray-700"><?= $countNA ?></span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            <?php 
            if (mysqli_num_rows($hasil) > 0) {
                while ($row = mysqli_fetch_assoc($hasil)) { 
                    $foto = !empty($row['foto_selfie']) ? $row['foto_selfie'] : 'default.png';
                    $ktp = !empty($row['photo_ktp']) ? $row['photo_ktp'] : '';
                    $nama = htmlspecialchars($row['nama_lengkap']);
                    $status = !empty($row['status']) ? $row['status'] : 'aktif';
                    $isAktif = ($status == 'aktif');
                    $employeeData = json_encode($row);
            ?>
                <div class="bg-white rounded-xl border border-pastel-border overflow-hidden flex flex-col group <?= $isAktif ? 'card-active' : 'card-disabled'; ?>">
                    <div class="relative h-32 bg-gray-50 overflow-hidden border-b border-pastel-border">
                        <img src="../../upload/<?= $foto; ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                             alt="<?= $nama; ?>"
                             onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($nama); ?>&background=C8E6C9&color=1B5E20&size=200'">
                        <div class="absolute top-2 right-2">
                             <span class="inline-block px-2 py-0.5 rounded text-[8px] font-bold uppercase tracking-wide shadow-sm 
                                <?= $isAktif ? 'bg-pastel-primary text-white' : 'bg-gray-200 text-gray-500'; ?>">
                                <?= $status; ?>
                             </span>
                        </div>
                    </div>
                    <div class="p-3 flex flex-col flex-grow text-center bg-white">
                        <h3 class="text-xs font-bold text-pastel-text uppercase truncate leading-tight mb-1" title="<?= $nama; ?>"><?= $nama; ?></h3>
                        <p class="text-[10px] font-semibold text-pastel-primary truncate"><?= !empty($row['nama_jabatan']) ? $row['nama_jabatan'] : '-'; ?></p>
                        <p class="text-[9px] text-gray-400 truncate mt-0.5"><?= !empty($row['nama_departement']) ? $row['nama_departement'] : '-'; ?></p>
                    </div>
                    <div class="px-2 pb-2 pt-0 mt-auto bg-white">
                        <div class="flex justify-center gap-1.5">
                            <button onclick='showEmployeeDetail(<?= htmlspecialchars($employeeData, ENT_QUOTES, 'UTF-8'); ?>)' 
                                    class="w-8 h-8 rounded-lg bg-gray-50 text-gray-500 hover:bg-pastel-bg hover:text-pastel-primary flex items-center justify-center transition-colors border border-gray-100" title="Detail Info">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                            </button>
                            <?php if($isAktif): ?>
                                <?php if($ktp): ?>
                                <button onclick="showKtpModal('../../upload/<?= $ktp; ?>', '<?= addslashes($nama); ?>')" 
                                        class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 hover:bg-blue-100 hover:text-blue-600 flex items-center justify-center transition-colors border border-blue-100" title="Lihat KTP">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 4h18a2 2 0 012 2v12a2 2 0 01-2 2H3a2 2 0 01-2-2V6a2 2 0 012-2z"/><circle cx="9" cy="10" r="2"/><path d="M15 13h4"/></svg>
                                </button>
                                <?php endif; ?>
                                <a href="edit.php?id_karyawan=<?= $row['id_karyawan']; ?>" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-500 hover:bg-amber-100 hover:text-amber-600 flex items-center justify-center transition-colors border border-amber-100" title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <a href="hapus.php?id_karyawan=<?= $row['id_karyawan']; ?>" onclick="return confirm('Non-aktifkan pegawai ini?')" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition-colors border border-red-100" title="Non-aktifkan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </a>
                            <?php else: ?>
                                <a href="controller/aktifController.php?id_karyawan=<?= $row['id_karyawan']; ?>" onclick="return confirm('Aktifkan kembali pegawai ini?')" 
                                   class="flex-1 h-8 rounded-lg bg-pastel-primary text-white text-[10px] font-bold uppercase tracking-wider hover:bg-pastel-hover flex items-center justify-center gap-2 transition-colors shadow-sm" title="Kembalikan Status Aktif">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    Aktifkan
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php 
                } 
            } else {
                echo '<div class="col-span-full py-20 text-center text-gray-400 bg-white/50 rounded-2xl border-2 border-dashed border-pastel-border">
                        <svg class="w-12 h-12 mx-auto mb-3 opacity-20 text-pastel-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <p class="text-xs font-bold uppercase tracking-widest text-pastel-text">Data tidak ditemukan</p>
                      </div>';
            } 
            ?>
        </div>

        <?php if($totalHalaman > 1): ?>
        <div class="mt-8 flex justify-center gap-1">
            <?php if($page > 1): ?>
                <a href="?halaman=<?= $page - 1; ?>&status=<?= $statusFilter ?>&search=<?= urlencode($cari) ?>" class="px-3 py-1 bg-white border border-pastel-border rounded-lg text-[10px] font-bold text-gray-500 hover:bg-pastel-bg hover:text-pastel-text transition-colors">Prev</a>
            <?php endif; ?>
            <?php for($x = 1; $x <= $totalHalaman; $x++): ?>
                <?php if($x == $page): ?>
                    <span class="px-3 py-1 bg-pastel-primary text-white rounded-lg text-[10px] font-bold shadow-sm"><?= $x; ?></span>
                <?php else: ?>
                    <a href="?halaman=<?= $x; ?>&status=<?= $statusFilter ?>&search=<?= urlencode($cari) ?>" class="px-3 py-1 bg-white border border-pastel-border rounded-lg text-[10px] font-bold text-gray-500 hover:bg-pastel-bg hover:text-pastel-text transition-colors"><?= $x; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if($page < $totalHalaman): ?>
                <a href="?halaman=<?= $page + 1; ?>&status=<?= $statusFilter ?>&search=<?= urlencode($cari) ?>" class="px-3 py-1 bg-white border border-pastel-border rounded-lg text-[10px] font-bold text-gray-500 hover:bg-pastel-bg hover:text-pastel-text transition-colors">Next</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-pastel-border z-50 px-4 py-3 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="../../dashboard.php" class="flex items-center gap-2 text-pastel-text font-bold text-sm hover:text-pastel-primary transition-colors px-3 py-2 rounded-lg hover:bg-pastel-bg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Dashboard
            </a>
            <span class="text-[10px] font-semibold text-gray-400">Direktori v1.0</span>
        </div>
    </div>

    <div id="detailModal" class="relative z-[110] hidden" role="dialog" aria-modal="true">
        <div id="detailBackdrop" class="fixed inset-0 bg-pastel-text/40 backdrop-blur-sm transition-opacity duration-300 ease-out opacity-0"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto pb-24">
            <div class="flex min-h-full items-center justify-center p-4">
                <div id="detailPanel" class="relative w-full max-w-lg transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all duration-300 ease-out opacity-0 translate-y-4 scale-95 border-4 border-white">
                    <div class="header-pattern px-6 py-4 border-b border-pastel-border flex justify-between items-center">
                        <h3 class="text-sm font-extrabold text-pastel-text uppercase tracking-wider">Detail Pegawai</h3>
                        <button onclick="closeDetailModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="p-6 bg-white">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="w-full md:w-1/3 flex flex-col items-center">
                                <div class="w-32 h-32 rounded-2xl overflow-hidden border-4 border-pastel-border shadow-md bg-pastel-bg">
                                    <img id="detailFoto" src="" class="w-full h-full object-cover" alt="Foto">
                                </div>
                                <div id="detailBadgeStatus" class="mt-4 px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest border-2 border-pastel-text text-pastel-text bg-white"></div>
                            </div>
                            <div class="w-full md:w-2/3 space-y-3">
                                <div><h4 id="detailNama" class="text-lg font-extrabold text-pastel-text leading-tight"></h4><p id="detailEmail" class="text-[10px] font-medium text-gray-500"></p></div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="p-2 bg-pastel-bg/50 rounded-lg border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-0.5">Status</p><p id="infoStatus" class="text-[11px] font-bold text-gray-700"></p></div>
                                    
                                    <div class="p-2 bg-pastel-bg/50 rounded-lg border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-0.5">Gender</p><p id="infoGender" class="text-[11px] font-bold text-gray-700"></p></div>
                                    <div class="p-2 bg-pastel-bg/50 rounded-lg border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-0.5">Jabatan</p><p id="infoJabatan" class="text-[11px] font-bold text-gray-700"></p></div>
                                    <div class="p-2 bg-pastel-bg/50 rounded-lg border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-0.5">Divisi</p><p id="infoDepartement" class="text-[11px] font-bold text-gray-700"></p></div>
                                    <div class="col-span-2 p-2 bg-pastel-bg/50 rounded-lg border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-0.5">TTL</p><p id="infoTTL" class="text-[11px] font-bold text-gray-700"></p></div>
                                    <div class="p-2 bg-pastel-bg/50 rounded-lg border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-0.5">Masuk</p><p id="infoTglMasuk" class="text-[11px] font-bold text-gray-700"></p></div>
                                    <div class="p-2 bg-pastel-bg/50 rounded-lg border border-pastel-border"><p class="text-[8px] font-extrabold text-pastel-text uppercase tracking-widest mb-0.5">No HP</p><p id="infoNoHp" class="text-[11px] font-bold text-gray-700"></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-white border-t border-pastel-border/30 flex justify-end gap-2">
                         <a id="btnEditDetail" href="#" class="px-5 py-2 bg-pastel-primary text-white rounded-full text-[10px] font-bold uppercase tracking-wider hover:bg-pastel-hover transition-colors shadow-sm">Cetak Card</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="ktpModal" class="relative z-[120] hidden" role="dialog" aria-modal="true">
        <div id="ktpBackdrop" class="fixed inset-0 bg-pastel-text/60 backdrop-blur-sm transition-opacity duration-300 ease-out opacity-0"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto pb-24">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div id="ktpPanel" class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all duration-300 ease-out w-full max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="px-6 py-4 border-b border-pastel-border flex justify-between items-center bg-pastel-bg/50">
                        <h3 class="text-[10px] font-extrabold text-pastel-text uppercase tracking-widest" id="ktpTitle">Berkas Identitas (KTP)</h3>
                        <button onclick="closeKtpModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="p-4 bg-gray-50 flex justify-center">
                        <img id="ktpImage" src="" alt="KTP" class="max-h-[50vh] w-auto rounded-lg shadow-sm border border-pastel-border">
                    </div>
                    <div class="px-4 py-3 bg-white border-t border-pastel-border/30 flex justify-end gap-2">
                        <a id="ktpDownload" href="#" download class="px-4 py-1.5 text-[10px] font-bold text-white bg-pastel-primary rounded-full shadow-sm hover:bg-pastel-hover">Unduh</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const detailModal = document.getElementById('detailModal');
        const detailBackdrop = document.getElementById('detailBackdrop');
        const detailPanel = document.getElementById('detailPanel');
        const ktpModal = document.getElementById('ktpModal');
        const ktpBackdrop = document.getElementById('ktpBackdrop');
        const ktpPanel = document.getElementById('ktpPanel');

        function showEmployeeDetail(data) {
            document.getElementById('detailNama').textContent = data.nama_lengkap || '-';
            document.getElementById('detailEmail').textContent = data.email || '-';
            
            // GANTI: NIP/NIK Pindah ke Bawah Foto (Badge)
            const badge = document.getElementById('detailBadgeStatus');
            badge.textContent = 'NIP: ' + (data.nik || '-');
            
            // GANTI: Status Pindah ke Grid (Menggantikan tempat NIK)
            document.getElementById('infoStatus').textContent = (data.status || 'Aktif').toUpperCase();
            
            document.getElementById('infoJabatan').textContent = data.nama_jabatan || '-';
            document.getElementById('infoDepartement').textContent = data.nama_departement || '-';
            document.getElementById('infoNoHp').textContent = data.no_hp || '-';
            document.getElementById('infoGender').textContent = (data.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
            
            const tglLahir = data.tanggal_lahir ? new Date(data.tanggal_lahir).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';
            document.getElementById('infoTTL').textContent = `${data.tempat_lahir || '-'}, ${tglLahir}`;
            
            const tglMasuk = data.tanggal_masuk ? new Date(data.tanggal_masuk).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';
            document.getElementById('infoTglMasuk').textContent = tglMasuk;
            
            const fotoPath = data.foto_selfie ? `../../upload/${data.foto_selfie}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(data.nama_lengkap)}&background=C8E6C9&color=1B5E20&size=200`;
            document.getElementById('detailFoto').src = fotoPath;
            
            document.getElementById('btnEditDetail').href = `detail.php?id_karyawan=${data.id_karyawan}`;

            detailModal.classList.remove('hidden');
            void detailModal.offsetWidth; 
            detailBackdrop.classList.remove('opacity-0');
            detailPanel.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
            detailPanel.classList.add('opacity-100', 'translate-y-0', 'scale-100');
        }

        function closeDetailModal() {
            detailBackdrop.classList.add('opacity-0');
            detailPanel.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
            detailPanel.classList.add('opacity-0', 'translate-y-4', 'scale-95');
            setTimeout(() => detailModal.classList.add('hidden'), 300);
        }

        function showKtpModal(src, name) {
            document.getElementById('ktpImage').src = src;
            document.getElementById('ktpTitle').textContent = 'KTP: ' + name;
            document.getElementById('ktpDownload').href = src;
            ktpModal.classList.remove('hidden');
            void ktpModal.offsetWidth;
            ktpBackdrop.classList.remove('opacity-0');
            ktpPanel.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
            ktpPanel.classList.add('opacity-100', 'scale-100');
        }

        function closeKtpModal() {
            ktpBackdrop.classList.add('opacity-0');
            ktpPanel.classList.remove('opacity-100', 'scale-100');
            ktpPanel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => ktpModal.classList.add('hidden'), 300);
        }
        window.onclick = (e) => {
            if (e.target.closest('#detailModal') && !e.target.closest('#detailPanel') && e.target.querySelector('#detailPanel')) closeDetailModal();
            if (e.target.closest('#ktpModal') && !e.target.closest('#ktpPanel') && e.target.querySelector('#ktpPanel')) closeKtpModal();
        }
        document.addEventListener('keydown', (e) => { if (e.key === "Escape") { closeDetailModal(); closeKtpModal(); } });
    </script>
</body>
</html>