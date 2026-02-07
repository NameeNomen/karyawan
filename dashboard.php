<?php
session_start();
include "koneksi.php";

// 1. CEK LOGIN
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

$nama_user = $_SESSION['nama_lengkap'] ?? 'Administrator';

// ==========================================
// DATA LOGIC
// ==========================================

$list_tahun = [];
$q_tahun = mysqli_query($conn, "SELECT DISTINCT YEAR(tanggal_masuk) as tahun FROM karyawan ORDER BY tahun DESC");
while($r = mysqli_fetch_assoc($q_tahun)){ $list_tahun[] = $r['tahun']; }
if(empty($list_tahun)) { $list_tahun[] = date('Y'); }
$tahun_pilih = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$total_karyawan = 0;
$q_kar = mysqli_query($conn, "SELECT COUNT(*) as total FROM karyawan");
if($q_kar) { $d = mysqli_fetch_assoc($q_kar); $total_karyawan = $d['total']; }

$total_dept = 0;
$q_dept = mysqli_query($conn, "SELECT COUNT(*) as total FROM departement");
if($q_dept) { $d = mysqli_fetch_assoc($q_dept); $total_dept = $d['total']; }

$total_jab = 0;
$q_jab = mysqli_query($conn, "SELECT COUNT(*) as total FROM jabatan");
if($q_jab) { $d = mysqli_fetch_assoc($q_jab); $total_jab = $d['total']; }

$jk_l = 0; $jk_p = 0;
$q_gender = mysqli_query($conn, "SELECT jenis_kelamin, COUNT(*) as total FROM karyawan GROUP BY jenis_kelamin");
if($q_gender) {
    while($row = mysqli_fetch_assoc($q_gender)) {
        if(strtoupper($row['jenis_kelamin']) == 'L') $jk_l = $row['total'];
        if(strtoupper($row['jenis_kelamin']) == 'P') $jk_p = $row['total'];
    }
}

$dept_labels = []; $dept_data = [];
$q_chart_dept = mysqli_query($conn, "SELECT d.nama_departement, COUNT(k.id_karyawan) as total FROM departement d LEFT JOIN karyawan k ON d.id_departement = k.id_departement GROUP BY d.id_departement");
while($row = mysqli_fetch_assoc($q_chart_dept)) { $dept_labels[] = $row['nama_departement']; $dept_data[] = $row['total']; }

$bulan_labels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
$bulan_data = array_fill(0, 12, 0); 
$q_chart_growth = mysqli_query($conn, "SELECT MONTH(tanggal_masuk) as bulan, COUNT(*) as total FROM karyawan WHERE YEAR(tanggal_masuk) = '$tahun_pilih' GROUP BY MONTH(tanggal_masuk)");
while($row = mysqli_fetch_assoc($q_chart_growth)) { $bulan_data[$row['bulan'] - 1] = $row['total']; }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard HRIS - Custom UI</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: { 
                        'pastel-bg': '#ecfdf5', 'pastel-border': '#a7f3d0', 'pastel-primary': '#10b981', 'pastel-dark': '#064e3b'
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #ecfdf5; background-image: radial-gradient(#6ee7b7 0.7px, transparent 0.7px); background-size: 24px 24px; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #a7f3d0; border-radius: 10px; }
    </style>
</head>

<body class="text-gray-800 font-sans antialiased relative">

<div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden backdrop-blur-sm transition-opacity"></div>

<div class="flex min-h-screen">

    <aside id="sidebar" class="w-64 bg-white/95 backdrop-blur-md border-r border-pastel-border flex flex-col fixed inset-y-0 left-0 z-50 shadow-xl transition-transform duration-300 transform -translate-x-full lg:translate-x-0">
        <div class="h-20 flex items-center justify-center relative border-b border-pastel-border bg-white/50">
            
            <img src="image/logotrijaya.png" alt="Logo" class="h-30 w-auto object-contain">
            
            <button onclick="toggleSidebar()" class="lg:hidden absolute right-6 text-gray-400 hover:text-red-500 transition-colors p-1">
                <i class="ph-bold ph-x text-2xl"></i>
            </button>
            
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <p class="px-4 text-xs font-bold text-emerald-600/70 uppercase tracking-widest mb-3">Menu Utama</p>
            <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl font-bold transition-all shadow-sm">
                <i class="ph-fill ph-squares-four text-xl text-emerald-600"></i> Dashboard
            </a>
            <a href="page/karyawan/list.php" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-100 border border-transparent rounded-xl font-medium transition-all group">
                <i class="ph-bold ph-users text-xl group-hover:scale-105 transition-transform text-gray-400 group-hover:text-emerald-500"></i> Data Karyawan
            </a>
            <a href="page/jabatan/list.php" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-100 border border-transparent rounded-xl font-medium transition-all group">
                <i class="ph-bold ph-briefcase text-xl group-hover:scale-105 transition-transform text-gray-400 group-hover:text-emerald-500"></i> Data Jabatan
            </a>
            <a href="page/departement/list.php" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-100 border border-transparent rounded-xl font-medium transition-all group">
                <i class="ph-bold ph-buildings text-xl group-hover:scale-105 transition-transform text-gray-400 group-hover:text-emerald-500"></i> Data Departemen
            </a>
        </nav>
        
        <div class="p-4 border-t border-pastel-border bg-emerald-50/30">
            <a href="page/auth/logout.php" class="flex items-center justify-center gap-2 w-full bg-white border border-red-100 text-red-500 py-2.5 rounded-lg text-sm font-bold hover:bg-red-50 hover:border-red-200 transition shadow-sm">
                <i class="ph-bold ph-sign-out text-lg"></i> Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 lg:ml-64 transition-all duration-300 w-full">
        
        <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-pastel-border px-4 md:px-8 py-4 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-200 hover:bg-emerald-100 transition">
                    <i class="ph-bold ph-list text-2xl"></i>
                </button>
                <div>
                    <h2 class="text-lg md:text-xl font-bold text-pastel-dark tracking-tight line-clamp-1">Dashboard</h2>
                    <p class="hidden md:block text-xs text-emerald-600 font-medium mt-0.5">Monitoring Data Kepegawaian</p>
                </div>
            </div>
            <div class="flex items-center gap-3 md:gap-4">
                <div class="hidden md:block text-right mr-2">
                    <p class="text-xs font-bold text-emerald-800"><?= date('l') ?></p>
                    <p class="text-[10px] text-emerald-600/80"><?= date('d F Y') ?></p>
                </div>
                <div class="flex items-center gap-3 pl-4 border-l border-emerald-100">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($nama_user) ?>&background=10b981&color=fff" class="w-9 h-9 rounded-full ring-2 ring-emerald-100 shadow-sm">
                    <div class="hidden md:block">
                        <p class="text-sm font-bold text-gray-700 leading-none"><?= htmlspecialchars($nama_user) ?></p>
                        <p class="text-[10px] text-emerald-500 font-bold mt-1">Administrator</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-4 md:p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-pastel-border shadow-sm flex flex-col justify-between h-32 relative overflow-hidden group">
                    <div><p class="text-emerald-600/80 text-xs font-bold uppercase tracking-wider">Karyawan Aktif</p><h3 class="text-3xl font-extrabold text-gray-800 mt-1"><?= $total_karyawan ?></h3></div>
                    <div class="absolute right-4 bottom-4 p-3 bg-emerald-50 rounded-xl text-emerald-600"><i class="ph-fill ph-users-three text-2xl"></i></div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-pastel-border shadow-sm flex flex-col justify-between h-32 relative overflow-hidden group">
                    <div><p class="text-emerald-600/80 text-xs font-bold uppercase tracking-wider">Departemen</p><h3 class="text-3xl font-extrabold text-gray-800 mt-1"><?= $total_dept ?></h3></div>
                    <div class="absolute right-4 bottom-4 p-3 bg-blue-50 rounded-xl text-blue-500"><i class="ph-fill ph-buildings text-2xl"></i></div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-pastel-border shadow-sm flex flex-col justify-between h-32 relative overflow-hidden group">
                    <div><p class="text-emerald-600/80 text-xs font-bold uppercase tracking-wider">Jabatan</p><h3 class="text-3xl font-extrabold text-gray-800 mt-1"><?= $total_jab ?></h3></div>
                    <div class="absolute right-4 bottom-4 p-3 bg-amber-50 rounded-xl text-amber-500"><i class="ph-fill ph-briefcase text-2xl"></i></div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-pastel-border shadow-sm flex flex-col justify-center h-32 relative overflow-hidden">
                    <p class="text-emerald-600/80 text-xs font-bold uppercase tracking-wider mb-3">Gender Ratio</p>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2"><div class="w-8 h-8 rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center"><i class="ph-bold ph-gender-male"></i></div><span class="font-bold text-lg text-gray-700"><?= $jk_l ?></span></div>
                        <div class="h-8 w-[1px] bg-emerald-100"></div>
                        <div class="flex items-center gap-2"><div class="w-8 h-8 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center"><i class="ph-bold ph-gender-female"></i></div><span class="font-bold text-lg text-gray-700"><?= $jk_p ?></span></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 mb-8">
                
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-pastel-border shadow-sm">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                            <i class="ph-duotone ph-trend-up text-emerald-500"></i> Grafik Karyawan
                        </h3>
                        
                        <form method="GET" action="" id="formTahun" class="w-full md:w-auto">
                            <input type="hidden" name="tahun" id="inputTahun" value="<?= $tahun_pilih ?>">
                            
                            <div class="relative w-full md:w-auto z-20">
                                
                                <button type="button" onclick="toggleCustomDropdown()" id="dropdownButton" 
                                    class="w-full md:w-40 flex items-center justify-between px-4 py-2.5 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-800 text-sm font-semibold rounded-xl shadow-sm transition-all focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                                    <div class="flex items-center gap-2">
                                        <i class="ph-bold ph-calendar-blank text-emerald-600"></i>
                                        <span id="dropdownLabel">Tahun <?= $tahun_pilih ?></span>
                                    </div>
                                    <i class="ph-bold ph-caret-down text-emerald-600"></i>
                                </button>

                                <div id="dropdownList" class="hidden absolute top-full right-0 mt-2 w-full md:w-48 bg-white border border-emerald-100 rounded-xl shadow-xl overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                                    <div class="p-1">
                                        <?php foreach($list_tahun as $thn): ?>
                                            <div onclick="selectYear('<?= $thn ?>')" 
                                                 class="cursor-pointer px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-colors flex items-center justify-between group">
                                                <span>Tahun <?= $thn ?></span>
                                                <?php if($thn == $tahun_pilih): ?>
                                                    <i class="ph-bold ph-check text-emerald-500"></i>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="relative h-64 w-full"><canvas id="growthChart"></canvas></div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-pastel-border shadow-sm">
                    <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                        <i class="ph-duotone ph-chart-pie-slice text-blue-500"></i> Komposisi Divisi
                    </h3>
                    <div class="relative h-64 w-full flex justify-center"><canvas id="deptChart"></canvas></div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">
                <div class="bg-white p-6 rounded-2xl border border-pastel-border shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                            <i class="ph-duotone ph-sparkle text-amber-400"></i> Karyawan Terbaru
                        </h3>
                        <a href="page/karyawan/list.php" class="text-sm text-emerald-600 font-bold hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            <thead>
                                <tr class="text-xs text-emerald-900/50 border-b border-emerald-100">
                                    <th class="py-3 font-semibold uppercase pl-2 w-[35%]">Nama Pegawai</th>
                                    <th class="py-3 font-semibold uppercase w-[25%]">NIPD</th>
                                    <th class="py-3 font-semibold uppercase w-[25%]">Tanggal Masuk</th>
                                    <th class="py-3 font-semibold uppercase text-right pr-2 w-[15%]">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-600">
                                <?php 
                                // LOGIC BARU:
                                // 1. Hitung tanggal 1 tahun yang lalu dari hari ini
                                $batas_waktu = date('Y-m-d', strtotime('-1 year'));

                                // 2. Query data:
                                //    - Ambil dari tabel karyawan
                                //    - Filter: Tanggal masuk harus LEBIH BESAR atau SAMA DENGAN batas waktu (artinya < 1 tahun)
                                //    - Urutkan dari yang paling baru
                                //    - Ambil maksimal 5
                                $q_recent = mysqli_query($conn, "SELECT * FROM karyawan WHERE tanggal_masuk >= '$batas_waktu' ORDER BY tanggal_masuk DESC LIMIT 5");
                                
                                // 3. Cek apakah ada datanya
                                if(mysqli_num_rows($q_recent) > 0) {
                                    while($row = mysqli_fetch_assoc($q_recent)) {
                                        $path_foto = "upload/" . $row['foto_selfie'];
                                        if (!empty($row['foto_selfie']) && file_exists($path_foto)) { $link_gambar = $path_foto; } 
                                        else { $link_gambar = "https://ui-avatars.com/api/?name=" . urlencode($row['nama_lengkap']) . "&background=d1fae5&color=065f46&size=64"; }
                                ?>
                                <tr class="hover:bg-emerald-50/60 transition border-b border-emerald-50 last:border-0">
                                    <td class="py-3 pr-4 pl-2">
                                        <div class="flex items-center gap-3">
                                            <img src="<?= $link_gambar ?>" class="w-8 h-8 rounded-full object-cover border border-emerald-200 ring-2 ring-emerald-50">
                                            <span class="font-bold text-emerald-900 line-clamp-1"><?= htmlspecialchars($row['nama_lengkap']) ?></span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-emerald-700"><?= htmlspecialchars($row['nip'] ?? '-') ?></td>
                                    <td class="py-3 text-emerald-700"><?= htmlspecialchars($row['tanggal_masuk'] ?? '-') ?></td>
                                    <td class="py-3 text-right pr-2">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">Baru</span>
                                    </td>
                                </tr>
                                <?php 
                                    } // end while
                                } else { 
                                    // 4. Jika kosong (semua karyawan > 1 tahun), tampilkan pesan kosong
                                ?>
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-400 italic bg-gray-50/50 rounded-lg">
                                        Tidak ada karyawan baru ( < 1 Tahun )
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    // --- 1. LOGIKA CUSTOM DROPDOWN ---
    function toggleCustomDropdown() {
        const list = document.getElementById('dropdownList');
        list.classList.toggle('hidden');
    }

    // Fungsi saat opsi tahun diklik
    function selectYear(tahun) {
        // Update input hidden
        document.getElementById('inputTahun').value = tahun;
        // Update label tombol (opsional, karena form akan submit)
        document.getElementById('dropdownLabel').innerText = 'Tahun ' + tahun;
        // Tutup dropdown
        document.getElementById('dropdownList').classList.add('hidden');
        // Submit form otomatis
        document.getElementById('formTahun').submit();
    }

    // Tutup dropdown jika klik di luar
    window.onclick = function(event) {
        if (!event.target.closest('#dropdownButton')) {
            const list = document.getElementById('dropdownList');
            if (!list.classList.contains('hidden')) {
                list.classList.add('hidden');
            }
        }
    }

    // --- 2. LOGIKA SIDEBAR MOBILE ---
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    // --- 3. CHART LOGIC ---
    const ctxGrowth = document.getElementById('growthChart').getContext('2d');
    new Chart(ctxGrowth, {
        type: 'bar',
        data: { labels: <?= json_encode($bulan_labels) ?>, datasets: [{ label: 'Pegawai Baru', data: <?= json_encode($bulan_data) ?>, backgroundColor: '#34d399', hoverBackgroundColor: '#10b981', borderRadius: 8, barThickness: 24 }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: '#ecfdf5', titleColor: '#064e3b', bodyColor: '#059669', borderColor: '#a7f3d0', borderWidth: 1, displayColors: false, callbacks: { label: function(context) { return 'Jumlah: ' + context.raw + ' Orang'; } } } },
            scales: {
                y: { beginAtZero: true, grid: { display: true, borderDash: [4, 4], drawBorder: false, color: '#d1fae5' }, ticks: { display: false }, title: { display: true, text: 'Jumlah Karyawan', font: { weight: 'bold', size: 12, family: "'Poppins', sans-serif" }, color: '#059669', padding: { bottom: 10 } } },
                x: { grid: { display: false }, ticks: { color: '#059669', font: { family: "'Poppins', sans-serif" } } }
            }
        }
    });

    const ctxDept = document.getElementById('deptChart').getContext('2d');
    new Chart(ctxDept, {
        type: 'doughnut',
        data: { labels: <?= json_encode($dept_labels) ?>, datasets: [{ data: <?= json_encode($dept_data) ?>, backgroundColor: ['#6ee7b7', '#93c5fd', '#fcd34d', '#fca5a5', '#c4b5fd', '#f9a8d4'], borderWidth: 2, borderColor: '#ffffff' }] },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { family: "'Poppins', sans-serif" }, color: '#4b5563' } } },
            cutout: '75%', layout: { padding: 10 }
        }
    });
</script>

</body>
</html>