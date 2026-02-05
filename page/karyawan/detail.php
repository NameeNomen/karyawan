<?php
include "../../koneksi.php";
include "controller/detailController.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card Premium - Professional Green</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        :root {
            --primary-green: #0a2e0c; /* Ijo alas ingkang langkung jero */
            --accent-green: #2e7d32;  
            --gold-accent: #d4af37;   /* Warna emas supados langkung méwah */
            --yellow-icon: #f1c40f;   
            --text-light: #ffffff;
            --bg-gray: #f4f7f6;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-gray);
            padding: 40px 20px;
        }

        .no-print {
            text-align: center; 
            margin-bottom: 40px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
            justify-content: center;
            max-width: 1300px;
            margin: 0 auto;
        }

        /* --- DESAIN ID CARD (LANDSCAPE) --- */
        .id-card {
            width: 600px;
            height: 350px;
            background: #fff;
            border-radius: 8px; 
            overflow: hidden; 
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            position: relative;
            display: flex;
        }

        /* Sidebar Kiri (Upgrade: Gradient & Texture) */
        .sidebar {
            width: 38%;
            background: linear-gradient(135deg, #0a2e0c 0%, #1b5e20 100%);
            position: relative;
            z-index: 10;
            padding: 60px 25px;
            color: white;
            clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
            border-right: 4px solid var(--gold-accent);
        }

        /* Pola geometris ingkang langkung mentes */
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 10px 10px;
            z-index: -1;
        }

        /* Aksen sorot alus (Glossy effect) */
        .sidebar::after {
            content: '';
            position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            z-index: -1;
        }

        /* Main Content Kanan */
        .main-content {
            width: 62%;
            margin-left: -5%; 
            position: relative;
            background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1200&auto=format&fit=crop'); 
            background-size: cover;
            background-position: center;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0.98) 15%, rgba(27, 94, 32, 0.05) 100%);
        }

        /* Header Logo */
        .company-header {
            position: absolute;
            top: 30px;
            left: 30px;
            z-index: 20;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .company-logo-icon {
            color: var(--primary-green);
            font-size: 26px;
        }

        .company-name {
            font-weight: 800;
            color: var(--primary-green);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* List Kontak ing Sidebar */
        .contact-list {
            margin-top: 40px;
            list-style: none;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 30px;
        }

        .icon-circle {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--gold-accent), var(--yellow-icon));
            border-radius: 6px; /* Kotak sithik luwih modern tinimbang bunder */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .icon-circle i {
            color: #000;
            font-size: 14px;
        }

        .contact-text {
            display: flex;
            flex-direction: column;
        }

        .contact-label {
            font-size: 8px;
            font-weight: 800;
            color: var(--gold-accent);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 2px;
        }

        .contact-val {
            font-size: 10px;
            font-weight: 600;
            line-height: 1.4;
            color: #ffffff;
        }

        /* Foto Profil */
        .profile-wrapper {
            position: absolute;
            top: 48%;
            right: 45px;
            transform: translateY(-50%);
            z-index: 30;
        }

        .profile-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            border: 6px solid #fff;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            background-color: #fff;
        }

        /* Name Tag Bawah */
        .name-tag {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 78%;
            background: var(--primary-green);
            padding: 25px 45px;
            color: white;
            clip-path: polygon(8% 0, 100% 0, 100% 100%, 0% 100%);
            z-index: 40;
            border-top: 2px solid var(--gold-accent);
        }

        .emp-name {
            font-size: 26px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .emp-name span {
            color: var(--gold-accent); 
        }

        .emp-role {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #a5d6a7;
            margin-top: 5px;
            opacity: 0.9;
        }

        /* Tombol Download */
        .btn-download {
            background: linear-gradient(135deg, var(--primary-green), #0d3d11);
            color: white;
            border: none;
            padding: 18px 50px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 800;
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            letter-spacing: 1px;
        }
        
        .btn-download:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }

    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="downloadAllCards()" class="btn-download">
            <i class="fas fa-id-card-alt"></i> Simpen ID Card (Kualitas HD)
        </button>
    </div>

    <div class="card-container">
        <?php 
        // Mesthekake data saking database sampun wonten
        if (isset($data) && mysqli_num_rows($data) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($data)) { 
                $i++;
                $cardID = "card_" . $i;
        ?>
            <!-- ID CARD START -->
            <div class="id-card" id="<?= $cardID; ?>">
                
                <!-- SIDEBAR KIRI (Upgrade: Kelas & Tekstur) -->
                <div class="sidebar">
                    <ul class="contact-list">
                        <!-- Nomer Telpon -->
                        <li class="contact-item">
                            <div class="icon-circle"><i class="fas fa-phone-alt"></i></div>
                            <div class="contact-text">
                                <span class="contact-label">Nomer Telpon</span>
                                <span class="contact-val"><?= htmlspecialchars($row['no_hp']); ?></span>
                            </div>
                        </li>
                        <!-- Alamat Perusahaan -->
                        <li class="contact-item">
                            <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-text">
                                <span class="contact-label">Alamat Kantor</span>
                                <span class="contact-val">JL. KRAJAN II, WARUNG BAMBU<br>KARAWANG TIMUR, JAWA BARAT</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- MAIN CONTENT KANAN -->
                <div class="main-content">
                    <!-- Header -->
                    <div class="company-header">
                        <div class="company-logo-icon"><i class="fas fa-crown"></i></div>
                        <div class="company-name">TRIJAYA <span style="color: #616161; font-weight: 400;">TEKNIK</span></div>
                    </div>

                    <!-- Foto Profil -->
                    <div class="profile-wrapper">
                        <img src="../../upload/<?= htmlspecialchars($row['foto_selfie']); ?>" 
                             class="profile-img" 
                             crossorigin="anonymous"
                             onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($row['nama_lengkap']); ?>&size=300&background=0a2e0c&color=fff'">
                    </div>

                    <!-- Tag Jeneng & Jabatan -->
                    <div class="name-tag">
                        <?php 
                            $nameParts = explode(' ', $row['nama_lengkap'], 2);
                            $firstName = $nameParts[0];
                            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
                        ?>
                        <div class="emp-name"><?= htmlspecialchars($firstName); ?> <span><?= htmlspecialchars($lastName); ?></span></div>
                        <div class="emp-role"><?= htmlspecialchars($row['nama_jabatan']); ?></div>
                    </div>
                </div>

            </div>
            <!-- ID CARD END -->
        <?php 
            } 
        } else {
             echo '<div style="width:100%; text-align:center; padding:50px; color:#999; font-weight:600;">Data mboten kapanggih.</div>';
        }
        ?>
    </div>

    <script>
        async function downloadAllCards() {
            const cards = document.querySelectorAll('.id-card');
            if(cards.length === 0) return;

            for (let i = 0; i < cards.length; i++) {
                const card = cards[i];
                const nameEl = card.querySelector('.emp-name');
                const name = nameEl ? nameEl.innerText.trim().replace(/\s+/g, '_') : 'IDCard_' + i;
                
                try {
                    const canvas = await html2canvas(card, {
                        scale: 4, // Kualitas langkung tajem
                        useCORS: true,
                        allowTaint: true,
                        backgroundColor: "#ffffff"
                    });
                    
                    const link = document.createElement('a');
                    link.download = `IDCard_${name}.jpg`;
                    link.href = canvas.toDataURL("image/jpeg", 1.0);
                    link.click();
                    
                    await new Promise(r => setTimeout(r, 700));
                } catch (err) {
                    console.error("Gagal export:", err);
                }
            }
        }
    </script>
</body>
</html>