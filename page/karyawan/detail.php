<?php
// Pastikan path koneksi sudah benar sesuai struktur folder Anda
include "../../koneksi.php";
include "controller/detailController.php";

// SEMENTARA: Uncomment baris di bawah ini untuk tes tampilan jika database belum connect
/*
$data = [
    [
        'id' => 1,
        'nama_lengkap' => 'Nicholson Parker',
        'nama_jabatan' => 'Senior Engineer',
        'nama_divisi' => 'Engineering',
        'no_hp' => '0812-3345-6310',
        'foto_selfie' => 'foto_sample.jpg' 
    ],
    [
        'id' => 2,
        'nama_lengkap' => 'Siti Aminah',
        'nama_jabatan' => 'Quality Control',
        'nama_divisi' => 'QC Dept',
        'no_hp' => '0857-7777-6666',
        'foto_selfie' => '' 
    ]
];
*/
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak ID Card - Professional Clean</title>
    
    <!-- Fonts: Roboto untuk keterbacaan maksimal (Ergonomis) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        :root {
            /* Palette Trijaya Professional */
            --primary-color: #064e3b;   /* Emerald Green Gelap */
            --secondary-color: #10b981; /* Emerald Green Cerah */
            --accent-gold: #f59e0b;     /* Gold Accent */
            --bg-card: #ffffff;
            
            --text-dark: #111827;
            --text-grey: #6b7280;
            
            --card-width: 320px;
            --card-height: 510px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f4f6;
            padding: 40px 20px;
        }

        .no-print {
            text-align: center; 
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
            justify-content: center;
            max-width: 1300px;
            margin: 0 auto;
        }

        /* --- FRAME KARTU --- */
        .id-card {
            width: var(--card-width); 
            height: var(--card-height);
            background: var(--bg-card);
            border-radius: 16px; 
            overflow: hidden; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
            display: flex;
            flex-direction: column;
            transform: translateZ(0); 
            border: 1px solid #e5e7eb;
        }

        /* --- BACKGROUND DECORATION --- */
        .bg-watermark {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 250px;
            height: 250px;
            opacity: 0.03;
            z-index: 0;
            filter: grayscale(100%);
            transform: rotate(-10deg);
        }

        /* --- HEADER (Clean Block) --- */
        .header-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: var(--primary-color);
            z-index: 1;
            /* Aksen lengkung sangat halus di bawah */
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        /* Garis Emas Tipis */
        .header-accent-line {
            position: absolute;
            top: 145px; /* Tepat di bawah header hijau */
            left: 15%;
            width: 70%;
            height: 4px;
            background: var(--accent-gold);
            border-radius: 2px;
            z-index: 2;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* --- LOGO & PERUSAHAAN --- */
        .header-content {
            position: absolute;
            top: 25px;
            width: 100%;
            text-align: center;
            z-index: 10;
        }

        .company-logo-img {
            height: 35px;
            width: auto;
            filter: brightness(0) invert(1); /* Logo Putih */
            margin-bottom: 5px;
        }
        
        .company-name {
            display: block;
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        /* --- FOTO PROFIL --- */
        .photo-container {
            position: absolute;
            top: 90px;
            left: 50%;
            transform: translateX(-50%);
            width: 130px;
            height: 130px;
            z-index: 20;
            background: var(--bg-card);
            padding: 5px;
            border-radius: 50%;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .photo-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
        }

        .photo-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* --- NAMA & JABATAN --- */
        .main-info {
            position: absolute;
            top: 230px; 
            width: 100%;
            text-align: center;
            z-index: 10;
            padding: 0 20px;
        }

        .emp-name {
            font-size: 20px;
            font-weight: 900;
            color: var(--text-dark);
            text-transform: uppercase;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }

        .emp-role {
            font-size: 12px;
            font-weight: 500;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            padding-bottom: 5px;
            border-bottom: 2px solid #e5e7eb;
        }

        /* --- DETAIL INFO (Grid Layout Rapi) --- */
        .info-grid {
            position: absolute;
            top: 310px;
            left: 50%;
            transform: translateX(-50%);
            width: 85%;
            z-index: 10;
            display: flex;
            flex-direction: column;
            gap: 15px; /* Jarak antar baris lega */
        }

        .info-item {
            display: flex;
            align-items: center;
        }

        .info-icon-box {
            width: 36px;
            height: 36px;
            background: #ecfdf5; /* Hijau sangat muda */
            color: var(--primary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .info-content {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 10px;
            color: var(--text-grey);
            font-weight: 500;
            text-transform: uppercase;
            margin-bottom: 1px;
        }

        .info-value {
            font-size: 13px;
            color: var(--text-dark);
            font-weight: 600;
        }

        /* --- FOOTER --- */
        .footer-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40px;
            background: var(--primary-color);
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .footer-text {
            color: #ffffff;
            font-size: 10px;
            font-weight: 400;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        /* Tombol Download */
        .btn-download {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-download:hover {
            transform: translateY(-2px);
            background: #047857;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Tombol Kembali */
        .btn-back {
            background: #6b7280;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            background: #4b5563;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            color: white;
        }
    </style>
</head>
<body>

    <div class="no-print">
        <a href="../../dashboard.php" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        <button onclick="downloadAllCards()" class="btn-download">
            <i class="fas fa-file-download"></i> Download Semua Kartu
        </button>
    </div>

    <div class="card-container">
        <?php 
        if (isset($data) && mysqli_num_rows($data) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($data)) { 
                $i++;
                $cardID = "card_" . $i;

                $nama       = isset($row['nama_lengkap']) ? $row['nama_lengkap'] : 'Nama Karyawan';
                $jabatan    = isset($row['nama_jabatan']) ? $row['nama_jabatan'] : 'Karyawan';
                $divisi     = isset($row['nama_divisi']) ? $row['nama_divisi'] : '-'; 
                $hp         = isset($row['no_hp']) ? $row['no_hp'] : '-';
                $foto       = isset($row['foto_selfie']) ? $row['foto_selfie'] : '';
                
                $nip = date('Y') . sprintf("%04d", $row['id'] ?? $i); 
        ?>
            <!-- ID CARD START -->
            <div class="id-card" id="<?= $cardID; ?>">
                
                <!-- BACKGROUND WATERMARK -->
                <img src="../../image/logotrijaya.png" class="bg-watermark" alt="Watermark" onerror="this.style.display='none'">

                <!-- HEADER -->
                <div class="header-bg"></div>
                <div class="header-accent-line"></div>
                
                <div class="header-content">
                    <img src="../../image/logotrijaya.png" 
                         class="company-logo-img" 
                         alt="Logo" 
                         onerror="this.src='https://placehold.co/100x50/transparent/ffffff?text=LOGO'">
                    <span class="company-name">TRIJAYA TEKNIK</span>
                </div>

                <!-- FOTO PROFIL -->
                <div class="photo-container">
                    <div class="photo-inner">
                        <img src="../../upload/<?= htmlspecialchars($foto); ?>" 
                             crossorigin="anonymous"
                             onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($nama); ?>&size=300&background=f3f4f6&color=374151&bold=true'">
                    </div>
                </div>

                <!-- MAIN INFO -->
                <div class="main-info">
                    <div class="emp-name"><?= htmlspecialchars($nama); ?></div>
                    <div class="emp-role"><?= htmlspecialchars($jabatan); ?></div>
                </div>

                <!-- DETAIL INFO (Ergonomic List) -->
                <div class="info-grid">
                    <!-- NIP -->
                    <div class="info-item">
                        <div class="info-icon-box"><i class="fas fa-id-card"></i></div>
                        <div class="info-content">
                            <span class="info-label">ID Number</span>
                            <span class="info-value"><?= $nip; ?></span>
                        </div>
                    </div>
                    <!-- DIVISI -->
                    <div class="info-item">
                        <div class="info-icon-box"><i class="fas fa-layer-group"></i></div>
                        <div class="info-content">
                            <span class="info-label">Division</span>
                            <span class="info-value"><?= htmlspecialchars($divisi); ?></span>
                        </div>
                    </div>
                    <!-- PHONE -->
                    <div class="info-item">
                        <div class="info-icon-box"><i class="fas fa-phone-alt"></i></div>
                        <div class="info-content">
                            <span class="info-label">Phone</span>
                            <span class="info-value"><?= htmlspecialchars($hp); ?></span>
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="footer-bar">
                    <span class="footer-text">Jl. Krajan II, Warung Bambu, Karawang Timur</span>
                </div>

            </div>
            <!-- ID CARD END -->
        <?php 
            } 
        } else {
             echo '<div class="alert alert-warning">Data karyawan tidak ditemukan.</div>';
        }
        ?>
    </div>

    <script>
        async function downloadAllCards() {
            const cards = document.querySelectorAll('.id-card');
            if(cards.length === 0) {
                alert("Tidak ada kartu untuk diunduh.");
                return;
            }

            const btn = document.querySelector('.btn-download');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            btn.disabled = true;

            for (let i = 0; i < cards.length; i++) {
                const card = cards[i];
                const nameEl = card.querySelector('.emp-name');
                const cleanName = nameEl ? nameEl.innerText.replace(/[^a-zA-Z0-9]/g, '_') : 'IDCard_' + i;
                
                try {
                    const canvas = await html2canvas(card, {
                        scale: 3, 
                        useCORS: true,
                        allowTaint: true,
                        backgroundColor: "#ffffff"
                    });
                    
                    const link = document.createElement('a');
                    link.download = `ID_${cleanName}.jpg`;
                    link.href = canvas.toDataURL("image/jpeg", 0.95);
                    link.click();
                    
                    await new Promise(r => setTimeout(r, 500));
                } catch (err) {
                    console.error("Gagal export:", err);
                }
            }
            
            btn.innerHTML = originalText;
            btn.disabled = false;
            alert("Selesai!");
        }
    </script>
</body>
</html>