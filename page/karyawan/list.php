<?php
include "../../koneksi.php";
$data = mysqli_query ($conn, "SELECT  k.id_karyawan, 
k.nama_lengkap,
k.email,
k.nik,
k.alamat,
k.no_hp,
k.jenis_kelamin,
k.tempat_lahir,
k.tanggal_lahir,
k.foto_selfie,
k.photo_ktp,
j.nama_jabatan,
d.nama_departement
FROM karyawan k
JOIN jabatan j on k.id_jabatan = j.id_jabatan
JoIN departement d on k.id_departement = d.id_departement;
");

?>

<?php

if (file_exists("../koneksi.php")) {
    include "../../koneksi.php";
}

// Query Data Karyawan (Join dengan Departemen & Jabatan jika ada)
$data = null;
if (isset($conn) && $conn) {
    // Sesuaikan nama kolom join dengan struktur database kamu
    // Menggunakan LEFT JOIN agar data tetap tampil meski departemen/jabatan dihapus/kosong
    $query = "SELECT k.*, d.nama_departement, j.nama_jabatan 
              FROM karyawan k 
              LEFT JOIN departement d ON k.id_departement = d.id_departement 
              LEFT JOIN jabatan j ON k.id_jabatan = j.id_jabatan 
              ORDER BY k.id_karyawan DESC";
    $data = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Pegawai</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Inter"', 'sans-serif'] },
                    colors: {
                        brand: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 900: '#1e3a8a' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen p-6 md:p-10">

    <div class="max-w-7xl mx-auto mb-10 flex flex-col md:flex-row justify-between items-end gap-4 border-b border-gray-200 pb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Data Pegawai</h1>
            <p class="text-gray-500 mt-1">Kelola data karyawan dan dokumen identitas.</p>
        </div>
        <div class="flex gap-3">
             <a href="../../dashboard.php" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors text-sm">Kembali</a>
             <a href="registrasi.php" class="px-5 py-2.5 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 transition-colors shadow-lg shadow-gray-900/20 text-sm flex items-center gap-2">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                Tambah Baru
             </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 xl:grid-cols-2 gap-6">
            
        <?php 
        if ($data && mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_assoc($data)) { 
                $foto = !empty($row['foto_selfie']) ? $row['foto_selfie'] : 'default.png';
                $ktp = !empty($row['photo_ktp']) ? $row['photo_ktp'] : '';
                $nama = htmlspecialchars($row['nama_lengkap']);
        ?>
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col sm:flex-row h-full">
                
                <div class="w-full sm:w-48 h-56 sm:h-auto shrink-0 relative bg-gray-100">
                    <img src="../../upload/<?= $foto; ?>" 
                         class="w-full h-full object-cover"
                         alt="<?= $nama; ?>"
                         onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($nama); ?>&background=random'">
                </div>

                <div class="p-5 flex flex-col flex-grow min-w-0">
                    
                    <div class="mb-4">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-bold text-gray-900 truncate pr-2" title="<?= $nama; ?>">
                                <?= $nama; ?>
                            </h3>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 truncate"><?= $row['email']; ?></p>
                    </div>

                    <div class="grid grid-cols-2 gap-y-3 gap-x-2 text-xs text-gray-600 mb-6">
                        <div>
                            <p class="text-gray-400 font-medium mb-0.5">Jabatan</p>
                            <p class="font-semibold text-gray-800 truncate"><?= !empty($row['nama_jabatan']) ? $row['nama_jabatan'] : '-'; ?></p>
                        </div>
                        <div>
                            <p class="text-gray-400 font-medium mb-0.5">Divisi</p>
                            <p class="font-semibold text-gray-800 truncate"><?= !empty($row['nama_departement']) ? $row['nama_departement'] : '-'; ?></p>
                        </div>
                        <div>
                            <p class="text-gray-400 font-medium mb-0.5">No HP</p>
                            <p class="font-mono text-gray-700"><?= !empty($row['no_hp']) ? $row['no_hp'] : '-'; ?></p>
                        </div>
                        <div>
                            <p class="text-gray-400 font-medium mb-0.5">Tgl Masuk</p>
                            <p class="text-gray-700"><?= !empty($row['tanggal_masuk']) ? $row['tanggal_masuk'] : '-'; ?></p>
                        </div>
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between gap-3">
                        
                        <?php if($ktp): ?>
                            <button onclick="showModal('../../upload/<?= $ktp; ?>', '<?= addslashes($nama); ?>')" 
                                    class="text-xs font-semibold text-brand-600 hover:text-brand-800 flex items-center gap-1.5 px-2 py-1.5 rounded-md hover:bg-brand-50 transition-colors">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 4h18a2 2 0 012 2v12a2 2 0 01-2 2H3a2 2 0 01-2-2V6a2 2 0 012-2z"/><path d="M12 11h.01"/><path d="M7 15h10"/></svg>
                                Lihat KTP
                            </button>
                        <?php else: ?>
                            <span class="text-xs text-gray-400 flex items-center gap-1.5 px-2">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg>
                                No KTP
                            </span>
                        <?php endif; ?>

                        <div class="flex items-center gap-1">
                            <a href="detail.php?id=<?= $row['id_karyawan']; ?>" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors" title="Detail">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                            </a>
                            <a href="edit.php?id_karyawan=<?= $row['id_karyawan']; ?>" class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <a href="hapus.php?id=<?= $row['id_karyawan']; ?>" onclick="return confirm('Hapus data?')" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        <?php 
            } 
        } else {
             echo '<div class="col-span-full text-center py-20 text-gray-500 bg-white rounded-xl border border-dashed border-gray-300">Belum ada data pegawai.</div>';
        } 
        ?>

    </div>

    <div id="ktpModal" class="fixed inset-0 z-[100] hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop"></div>
        
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all w-full max-w-2xl opacity-0 translate-y-4 scale-95" id="modalPanel">
                    
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Preview Identitas</h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="p-6 bg-gray-100 flex justify-center">
                        <img id="modalImage" src="" alt="KTP" class="max-h-[60vh] w-auto rounded-lg shadow-md border border-gray-200">
                    </div>

                    <div class="px-6 py-4 bg-white border-t border-gray-100 flex justify-end gap-3">
                        <button onclick="closeModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Tutup</button>
                        <a id="downloadBtn" href="#" download class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800">Download</a>
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
            modalTitle.innerText = 'KTP: ' + name;
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