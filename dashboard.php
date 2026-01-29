<?php

    include "koneksi.php";


$total_karyawan = 0;

if (isset($conn) && $conn) {
    // Hitung Karyawan
    $query_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM karyawan");
    if ($query_count) {
        $data_count = mysqli_fetch_assoc($query_count);
        $total_karyawan = $data_count['total'];
    }
} else {
    $total_karyawan = "0"; 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard Kepegawaian  - Tri jaya teknik karawang</title>
    
    <!-- FONT POPPINS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Konfigurasi Tema -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Poppins"', 'sans-serif'],
                    },
                    colors: {
                        emerald: {
                            50: '#f4fcf8',
                            100: '#e3f0e9',
                            200: '#c2e0d3',
                            300: '#86efac', 
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#022c22', 
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1fae5; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #10b981; }

        /* Glassmorphism Classes (Untuk Header & Widget Utama) */
        .glass-card {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem; 
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 30px -5px rgba(16, 185, 129, 0.05);
            transition: all 0.3s ease;
        }

        /* Pastel Card Classes (Untuk Menu Tombol) */
        .pastel-card {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            /* Background akan di-set manual per kartu */
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pastel-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.06);
            border-color: rgba(255, 255, 255, 0.8);
        }

        /* Arrow Button Style */
        .arrow-btn {
            opacity: 0.6;
            transition: all 0.3s;
        }
        .pastel-card:hover .arrow-btn {
            opacity: 1;
            transform: translateX(5px);
        }

        /* Khusus widget sambutan */
        .glass-card.welcome {
            background: rgba(255, 255, 255, 0.4);
            border: none;
        }
    </style>
</head>
<body class="bg-[#f4fcf8] text-gray-800 min-h-screen relative selection:bg-emerald-200 selection:text-emerald-900 overflow-x-hidden">

    <!-- Background Ambience -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute top-[-10%] left-[-5%] w-[50%] h-[50%] bg-emerald-100/60 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-teal-100/60 rounded-full blur-[100px]"></div>
        <div class="absolute top-[40%] left-[40%] w-[30%] h-[30%] bg-blue-50/60 rounded-full blur-[100px]"></div>
    </div>

    <!-- Main Content -->
    <main class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10 pb-32">
        
        <!-- Header Minimalis -->
        <header class="flex flex-col md:flex-row justify-between items-center mb-8 md:mb-12 gap-4 md:gap-0">
            <div class="flex items-center gap-3 w-full md:w-auto">
                <div class="w-50 h-50  rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-200 text-white shrink-0">
                    <!-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><path d="M9 1v3"></path><path d="M15 1v3"></path><path d="M9 20v3"></path><path d="M15 20v3"></path><path d="M20 9h3"></path><path d="M20 14h3"></path><path d="M1 9h3"></path><path d="M1 14h3"></path></svg> -->
                     <img src="image/logotrijaya.png" alt="" width="200px">
                </div>
                <span class="font-bold text-xl tracking-wide text-gray-700 truncate">
                    Dashboard Kepegawaian  -<span class="text-emerald-500"> Tri jaya teknik karawang</span>
                </span>
            </div>
            
            <!-- <div class="flex gap-4 w-full md:w-auto justify-end">
                 <button class="w-10 h-10 rounded-full bg-white p-[2px] shadow-sm hover:shadow-md transition-shadow">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix" alt="User" class="w-full h-full rounded-full bg-emerald-50">
                 </button>
            </div> -->
        </header>

        <!-- BENTO GRID LAYOUT -->
        <div class="grid grid-cols-12 gap-4 md:gap-6 lg:gap-8 pb-24">
            
            <!-- 1. WELCOME WIDGET (Clock) -->
            <!-- Layout: Mobile 12, Tablet 12, Laptop 8 -->
            <div class="glass-card welcome col-span-12 lg:col-span-8 p-6 md:p-8 flex flex-col justify-between h-auto min-h-[14rem] md:min-h-[16rem] relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-100 to-teal-50 z-0 opacity-80"></div>
                <div class="absolute top-[-20%] right-[-5%] w-64 h-64 bg-emerald-200/40 rounded-full blur-3xl z-0"></div>
                
                <div class="flex justify-between items-start relative z-10 mb-4 md:mb-0">
                    <div>
                       <div class="flex items-center gap-2 mb-2">
                          <span class="px-3 py-1 rounded-full text-[10px] md:text-[11px] font-semibold bg-white/50 text-emerald-700 border border-white/50 tracking-wide uppercase backdrop-blur-sm shadow-sm">
                            System Active
                          </span>
                       </div>
                      <h2 id="live-date" class="text-emerald-800/60 font-medium text-sm md:text-lg tracking-wide">...</h2>
                      <!-- Font size lebih dinamis agar tidak pecah di HP kecil -->
                      <h1 id="live-clock" class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-emerald-900 tracking-tight mt-1 font-sans">
                        ...
                      </h1>
                    </div>
                    <div class="bg-white/40 p-3 md:p-4 rounded-2xl border border-white/60 backdrop-blur-md shadow-sm text-emerald-600">
                        <svg class="w-6 h-6 md:w-8 md:h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.5a5.5 5.5 0 0 1 5.5 5.5c0 2.3-1.4 4.3-3.5 5.2A5.5 5.5 0 0 1 12 18.5V21a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-6c0-1.3.5-2.5 1.4-3.4A5.5 5.5 0 0 1 12 2.5z"></path><path d="M12 18.5a5.5 5.5 0 0 1-5.5-5.5c0-2.3 1.4-4.3 3.5-5.2"></path></svg>
                    </div>
                </div>

                <div class="relative z-10 border-t border-emerald-900/5 pt-4 mt-2">
                    <div class="flex justify-between items-end">
                        <div>
                            <h3 class="text-lg md:text-2xl font-semibold text-emerald-900 tracking-tight">
                                Halo, <span class="text-emerald-600">Admin</span>
                            </h3>
                            <p class="text-emerald-700/60 text-xs md:text-sm mt-1 flex items-center gap-2">
                                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                                Dashboard siap.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. TOTAL KARYAWAN WIDGET -->
            <!-- Layout: Mobile 12, Tablet 12, Laptop 4 -->
            <div class="glass-card col-span-12 lg:col-span-4 p-6 md:p-8 h-auto lg:h-auto flex flex-col justify-between bg-gradient-to-br from-white to-emerald-50/50 min-h-[12rem]">
                <div class="flex justify-between items-start mb-4 lg:mb-0">
                    <div class="p-3 bg-emerald-100 rounded-2xl border border-emerald-200">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-600"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <span class="text-emerald-600 text-[10px] md:text-xs flex items-center gap-1 bg-emerald-50 px-2 py-1 rounded-full font-bold border border-emerald-100 uppercase tracking-wider">
                        Pegawai Aktif
                    </span>
                </div>
                <div>
                    <h3 class="text-5xl md:text-6xl font-bold text-emerald-900 tracking-tighter mb-2">
                        <?= $total_karyawan; ?>
                    </h3>
                    <div class="w-full h-2 bg-emerald-100 rounded-full overflow-hidden">
                        <div class="h-full w-3/4 bg-emerald-400 rounded-full"></div>
                    </div>
                    <p class="text-xs text-gray-400 mt-3 font-medium">Update: Realtime</p>
                </div>
            </div>

            <!-- GROUP: MENU UTAMA (PASTEL COLORS) -->
            <!-- 
                RESPONSIVE BREAKPOINTS:
                - Mobile (< 640px): col-span-12 (1 Kolom Full)
                - Tablet (sm - lg): col-span-6 (2 Kolom)
                - Desktop (lg+): col-span-4 (3 Kolom)
                
                Ini membuat transisi layout lebih rapi.
            -->
            
            <!-- 3. TAMBAH PEGAWAI (Soft Emerald) -->
            <a href="page/karyawan/registrasi.php" class="pastel-card col-span-12 sm:col-span-6 lg:col-span-4 p-4 md:p-6 h-auto lg:h-48 flex flex-row lg:flex-col justify-start lg:justify-center items-center text-left lg:text-center group bg-emerald-100/80 hover:bg-emerald-200/90 gap-4">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white/60 md:mb-4 flex items-center justify-center text-emerald-600 shadow-sm group-hover:scale-110 group-hover:bg-white group-hover:text-emerald-700 transition-all duration-300 shrink-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base md:text-lg font-bold text-emerald-900 group-hover:text-emerald-950 transition-colors">Tambah Pegawai</h3>
                    <p class="text-xs md:text-sm text-emerald-700/70 mt-0.5 md:mt-1 font-medium">Input Karyawan Baru</p>
                </div>
                <!-- Arrow visible on hover or mobile -->
                <div class="arrow-btn p-2 rounded-full bg-white/30 text-emerald-800 lg:opacity-0 lg:group-hover:opacity-100">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                </div>
            </a>

            <!-- 4. TAMBAH DIVISI (Soft Teal) -->
            <a href="page/departement/tambah.php" class="pastel-card col-span-12 sm:col-span-6 lg:col-span-4 p-4 md:p-6 h-auto lg:h-48 flex flex-row lg:flex-col justify-start lg:justify-center items-center text-left lg:text-center group bg-teal-100/80 hover:bg-teal-200/90 gap-4">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white/60 md:mb-4 flex items-center justify-center text-teal-600 shadow-sm group-hover:scale-110 group-hover:bg-white group-hover:text-teal-700 transition-all duration-300 shrink-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><line x1="3" y1="14" x2="10" y2="14"></line><line x1="6.5" y1="11" x2="6.5" y2="17"></line></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base md:text-lg font-bold text-teal-900 group-hover:text-teal-950 transition-colors">Tambah Divisi</h3>
                    <p class="text-xs md:text-sm text-teal-700/70 mt-0.5 md:mt-1 font-medium">Departemen Baru</p>
                </div>
                <div class="arrow-btn p-2 rounded-full bg-white/30 text-teal-800 lg:opacity-0 lg:group-hover:opacity-100">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                </div>
            </a>

            <!-- 5. TAMBAH JABATAN (Soft Sky) -->
            <a href="page/jabatan/tambah.php" class="pastel-card col-span-12 sm:col-span-6 lg:col-span-4 p-4 md:p-6 h-auto lg:h-48 flex flex-row lg:flex-col justify-start lg:justify-center items-center text-left lg:text-center group bg-sky-100/80 hover:bg-sky-200/90 gap-4">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white/60 md:mb-4 flex items-center justify-center text-sky-600 shadow-sm group-hover:scale-110 group-hover:bg-white group-hover:text-sky-700 transition-all duration-300 shrink-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 11v6"></path><path d="M9 14h6"></path><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base md:text-lg font-bold text-sky-900 group-hover:text-sky-950 transition-colors">Tambah Jabatan</h3>
                    <p class="text-xs md:text-sm text-sky-700/70 mt-0.5 md:mt-1 font-medium">Posisi Baru</p>
                </div>
                <div class="arrow-btn p-2 rounded-full bg-white/30 text-sky-800 lg:opacity-0 lg:group-hover:opacity-100">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                </div>
            </a>


            <!-- GROUP: LIST DATA (PASTEL COLORS) -->

            <!-- 6. DATA PEGAWAI (Soft Lime) -->
            <a href="page/karyawan/list.php" class="pastel-card col-span-12 sm:col-span-6 lg:col-span-4 p-4 md:p-6 h-auto lg:h-48 flex flex-row lg:flex-col justify-start lg:justify-center items-center text-left lg:text-center group bg-lime-100/80 hover:bg-lime-200/90 gap-4">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white/60 md:mb-4 flex items-center justify-center text-lime-700 shadow-sm group-hover:scale-110 group-hover:bg-white group-hover:text-lime-800 transition-all duration-300 shrink-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base md:text-lg font-bold text-lime-900 group-hover:text-lime-950 transition-colors">Data Pegawai</h3>
                    <p class="text-xs md:text-sm text-lime-800/70 mt-0.5 md:mt-1 font-medium">Kelola Database</p>
                </div>
                <div class="arrow-btn p-2 rounded-full bg-white/30 text-lime-800 lg:opacity-0 lg:group-hover:opacity-100">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                </div>
            </a>

            <!-- 7. LIST DIVISI (Soft Cyan) -->
            <a href="page/departement/list.php" class="pastel-card col-span-12 sm:col-span-6 lg:col-span-4 p-4 md:p-6 h-auto lg:h-48 flex flex-row lg:flex-col justify-start lg:justify-center items-center text-left lg:text-center group bg-cyan-100/80 hover:bg-cyan-200/90 gap-4">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white/60 md:mb-4 flex items-center justify-center text-cyan-600 shadow-sm group-hover:scale-110 group-hover:bg-white group-hover:text-cyan-700 transition-all duration-300 shrink-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line><path d="M12 14v-4"></path><path d="M12 6h.01"></path></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base md:text-lg font-bold text-cyan-900 group-hover:text-cyan-950 transition-colors">List Divisi</h3>
                    <p class="text-xs md:text-sm text-cyan-800/70 mt-0.5 md:mt-1 font-medium">Struktur Organisasi</p>
                </div>
                <div class="arrow-btn p-2 rounded-full bg-white/30 text-cyan-800 lg:opacity-0 lg:group-hover:opacity-100">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                </div>
            </a>

            <!-- 8. LIST JABATAN (Soft Green) -->
            <a href="page/jabatan/list.php" class="pastel-card col-span-12 sm:col-span-6 lg:col-span-4 p-4 md:p-6 h-auto lg:h-48 flex flex-row lg:flex-col justify-start lg:justify-center items-center text-left lg:text-center group bg-green-100/80 hover:bg-green-200/90 gap-4">
                <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white/60 md:mb-4 flex items-center justify-center text-green-600 shadow-sm group-hover:scale-110 group-hover:bg-white group-hover:text-green-700 transition-all duration-300 shrink-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-base md:text-lg font-bold text-green-900 group-hover:text-green-950 transition-colors">List Jabatan</h3>
                    <p class="text-xs md:text-sm text-green-800/70 mt-0.5 md:mt-1 font-medium">Daftar Posisi</p>
                </div>
                <div class="arrow-btn p-2 rounded-full bg-white/30 text-green-800 lg:opacity-0 lg:group-hover:opacity-100">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                </div>
            </a>

        </div>

    </main>

    <!-- FLOATING DOCK (Navigation) -->
    <!-- Scale down di mobile agar muat -->
   

    <!-- Script Jam Digital -->
    <script>
        function updateClock() {
            const now = new Date();
            
            // Jam
            const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('live-clock').innerText = timeString;
            
            // Tanggal
            const dateString = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long' });
            document.getElementById('live-date').innerText = dateString;
        }

        setInterval(updateClock, 1000);
        updateClock(); // Run immediately
    </script>
</body>
</html>