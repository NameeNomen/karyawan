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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan - Premium Landscape</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        /* Reset & Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #e8f5e9;
            padding: 40px 20px;
            color: #333;
        }

        .no-print {
            text-align: center; 
            margin-bottom: 40px;
        }

        /* Container Grid */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* --- DESAIN ID CARD MODERN LANDSCAPE --- */
        .id-card {
            width: 500px;
            height: 300px;
            background: #fff;
            border-radius: 15px;
            overflow: hidden; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            position: relative;
            display: flex;
            transition: transform 0.3s ease;
        }

        .id-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(27, 94, 32, 0.2);
        }

        /* Sisi Kiri (Hijau - Foto & ID) */
        .left-section {
            width: 40%;
            background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
            z-index: 2;
        }

        /* Pattern Geometris Samar di Background Hijau */
        .left-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 10px 10px;
            opacity: 0.5;
        }

        /* Elemen Dekoratif Miring (Slant) */
        .left-section::after {
            content: '';
            position: absolute;
            top: 0;
            right: -30px; /* Overlap ke bagian putih */
            width: 60px;
            height: 100%;
            background: inherit;
            transform: skewX(-10deg);
            z-index: -1;
            border-right: 5px solid rgba(255,255,255,0.2);
        }

        /* Foto Profil */
        .photo-container {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            padding: 4px;
            background: rgba(255,255,255,0.2);
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            background-color: #fff;
        }

        /* ID Number di Bawah Foto */
        .id-badge {
            background: rgba(0,0,0,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
            position: relative;
            z-index: 2;
        }
        
        .id-badge span {
            display: block;
            font-size: 0.6rem;
            opacity: 0.8;
            text-align: center;
            margin-bottom: 2px;
        }

        /* Sisi Kanan (Putih - Info Teks) */
        .right-section {
            flex: 1;
            padding: 25px 30px 45px 50px; /* Padding bawah ditambah untuk alamat */
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        /* Header Logo Kanan Atas - DIPERBAIKI */
        .header-logo {
            position: absolute;
            top: 25px; /* Posisi lebih pas di dalam kartu */
            right: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 10;
        }

        .logo-img {
            width: 50px; /* Ukuran logo lebih proporsional */
            height: 50px;
            object-fit: contain;
        }
        
        
        .logo-text {
            font-weight: 700;
            color: #1b5e20;
            font-size: 1rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Info Utama */
        .info-block {
            margin-top: 10px;
            z-index: 5;
        }

        .emp-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #222;
            text-transform: uppercase;
            line-height: 1.2;
            margin-bottom: 5px;
        }

        .emp-role {
            font-size: 0.9rem;
            color: #2e7d32;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: inline-block;
            border-bottom: 2px solid #a5d6a7;
            padding-bottom: 3px;
        }

        /* Detail Grid */
        .detail-row {
            display: flex;
            align-items: center;
            margin-bottom: 6px;
            font-size: 0.8rem;
            color: #555;
        }

        .detail-row i {
            width: 20px;
            color: #81c784;
            margin-right: 8px;
        }
        
        .detail-label {
            font-weight: 600;
            margin-right: 5px;
            color: #444;
        }

        /* Alamat di Bawah */
        .card-address {
            position: absolute;
            bottom: 15px;
            left: 50px; /* Sejajar dengan konten teks */
            font-size: 0.65rem;
            color: #777;
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 5;
            max-width: 90%;
            line-height: 1.2;
        }

        .card-address i {
            color: #2e7d32;
            font-size: 0.8rem;
        }

        /* Footer Dekoratif Kanan Bawah */
        .card-footer-decor {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, transparent 50%, #e8f5e9 50%);
            border-bottom-right-radius: 15px;
            z-index: 1;
        }

        /* Tombol Download */
        .btn-download {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(27, 94, 32, 0.3);
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-download:hover {
            background-color: #1b5e20;
            transform: translateY(-2px);
        }

    </style>
</head>
<body>

    <div class="no-print">
        <h2 style="color: #1b5e20; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">ID Card Generator</h2>
        <button onclick="downloadAllCards()" class="btn-download">
            <i class="fas fa-download"></i> Download Semua (JPG)
        </button>
    </div>

    <div class="card-container">
        <?php 
        // Note: Pastikan $data dari database sudah tersedia
        if (isset($data) && mysqli_num_rows($data) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($data)) { 
                $i++;
                $cardID = "card_" . $i;
        ?>
            <!-- ID CARD START -->
            <div class="id-card" id="<?= $cardID; ?>">
                
                <!-- SISI KIRI (HIJAU) -->
                <div class="left-section">
                    <div class="photo-container">
                        <img src="../../upload/<?= htmlspecialchars($row['foto_selfie']); ?>" 
                             class="profile-img" 
                             crossorigin="anonymous"
                             onerror="this.src='https://via.placeholder.com/200?text=FOTO'">
                    </div>
                    
                    <div class="id-badge">
                        <span>ID CARD NO.</span>
                        <?= htmlspecialchars($row['id_karyawan']); ?>
                    </div>
                </div>

                <!-- SISI KANAN (PUTIH) -->
                <div class="right-section">
                    
                    <!-- Logo Perusahaan -->
                    <div class="header-logo">
                        <!-- <img src="../../image/logotrijaya.png" class="logo-img" alt="Logo" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2970/2970079.png'"> -->
                        <div class="logo-text">Tri Jaya Teknik Karawang</div>
                    </div>

                    <!-- Info Utama -->
                    <div class="info-block">
                        <div class="emp-name"><?= htmlspecialchars($row['nama_lengkap']); ?></div>
                        <div class="emp-role"><?= htmlspecialchars($row['nama_jabatan']); ?></div>
                        
                        <!-- Detail Info -->
                        <div class="detail-row">
                            <i class="fas fa-building"></i>
                            <div>
                                <span class="detail-label">Dept:</span>
                                <?= htmlspecialchars($row['nama_departement']); ?>
                            </div>
                        </div>
                        <div class="detail-row">
                            <i class="fas fa-phone"></i>
                            <div>
                                <span class="detail-label">Phone:</span>
                                <?= htmlspecialchars($row['no_hp']); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Bawah -->
                    <div class="card-address">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jl. Alternatif Krajan II, Warung Bambu, Kabupaten Karawang</span>
                    </div>

                    <!-- Dekorasi Sudut -->
                    <div class="card-footer-decor"></div>
                </div>

            </div>
            <!-- ID CARD END -->
        <?php 
            } // End While
        } else {
             echo '<div style="text-align:center; width:100%; color:#888;">
                    <i class="fas fa-inbox" style="font-size:3rem; margin-bottom:10px;"></i>
                    <p>Tidak ada data karyawan ditemukan.</p>
                   </div>';
        }
        ?>
    </div>

    <script>
        async function downloadAllCards() {
            const cards = document.querySelectorAll('.id-card');
            
            if(cards.length === 0) {
                alert("Tidak ada kartu untuk didownload");
                return;
            }

            if(cards.length > 5) {
                if(!confirm(`Ada ${cards.length} kartu. Lanjutkan download?`)) return;
            }

            for (let i = 0; i < cards.length; i++) {
                const card = cards[i];
                const nameEl = card.querySelector('.emp-name');
                const name = nameEl ? nameEl.innerText.trim().replace(/\s+/g, '_') : 'IDCard_' + i;
                
                try {
                    const canvas = await html2canvas(card, {
                        scale: 2, // Resolusi tinggi
                        useCORS: true,
                        backgroundColor: null // Transparan agar sudut rounded terambil rapi
                    });
                    
                    const link = document.createElement('a');
                    link.download = `IDCard_${name}.jpg`;
                    link.href = canvas.toDataURL("image/jpeg", 0.9);
                    link.click();
                    
                    await new Promise(r => setTimeout(r, 300));
                } catch (err) {
                    console.error("Gagal download kartu " + name, err);
                }
            }
            alert("Selesai!");
        }
    </script>
</body>
</html>