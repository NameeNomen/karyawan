<?php
include "controller/regisController.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Input Data Karyawan</title>

<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<script>
tailwind.config = {
    theme: {
        extend: {
            fontFamily: { sans: ['Quicksand', 'sans-serif'] },
            colors: {
                // Palet Hijau Custom
                ijo: {
                    bg: '#ecfdf5',      /* Background Page */
                    card: '#f0fdf4',    /* Background Card (Putih kehijauan) */
                    input: '#dcfce7',   /* Input: Ijo Pastel Muda */
                    border: '#15803d',  /* Border: Ijo Tua (Tebal & Tegas) */
                    text: '#052e16',    /* Teks: Ijo Sangat Gelap */
                    hover: '#bbf7d0',   /* Hover Input */
                    btn: '#166534'      /* Tombol Ijo Tua */
                }
            }
        }
    }
}
</script>

<style>
    *{
            /* text-transform:capitalize; */
        }
    /* PATTERN BACKGROUND ESTETIK: GINGHAM (Kotak-kotak Pudar) */
    body {
        background-color: #ecfdf5;
        background-image: 
            linear-gradient(90deg, rgba(21, 128, 61, 0.05) 1px, transparent 1px),
            linear-gradient(rgba(21, 128, 61, 0.05) 1px, transparent 1px);
        background-size: 20px 20px;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    /* --- GAYA INPUT --- */
    label {
        color: #166534; /* Ijo Tua */
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 4px;
        display: block;
        margin-left: 4px;
    }

    .form-input {
        width: 100%;
        padding: 10px 14px;
        font-size: 14px;
        font-weight: 600;
        color: #052e16;
        background-color: #dcfce7; /* Ijo Pastel Muda */
        border: 2px solid #15803d; /* BORDER PALING TUA */
        border-radius: 12px;
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        background-color: #f0fdf4;
        box-shadow: 0 4px 0 rgba(21, 128, 61, 0.2); /* Efek timbul ijo */
        transform: translateY(-1px);
    }

    /* Placeholder warnanya ijo pudar */
    ::placeholder { color: #86efac; }

    /* --- CUSTOM SELECT STYLE --- */
    .custom-select-wrapper {
        position: relative;
        width: 100%;
    }

    .custom-select-trigger {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 14px;
        background-color: #dcfce7;
        border: 2px solid #15803d; /* Border Tua */
        border-radius: 12px;
        cursor: pointer;
        color: #052e16;
        font-weight: 600;
        font-size: 14px;
        transition: 0.2s;
    }

    .custom-select.open .custom-select-trigger {
        background-color: #f0fdf4;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .custom-options {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 2px solid #15803d;
        border-top: none;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        z-index: 50;
        display: none;
        max-height: 200px;
        overflow-y: auto;
    }

    .custom-select.open .custom-options {
        display: block;
    }

    .custom-option {
        padding: 10px 14px;
        cursor: pointer;
        color: #166534;
        font-weight: 500;
        font-size: 14px;
        border-bottom: 1px dashed #bbf7d0;
    }

    .custom-option:hover {
        background-color: #dcfce7;
        color: #052e16;
        font-weight: 700;
    }

    .custom-option.selected {
        background-color: #bbf7d0;
    }

    /* Arrow Icon */
    .arrow {
        width: 0; height: 0; 
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 6px solid #15803d; /* Panah Ijo Tua */
        transition: 0.2s;
    }
    .custom-select.open .arrow { transform: rotate(180deg); }

    /* Custom Input File */
    input[type="file"]::file-selector-button {
        background-color: #15803d;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 8px;
        margin-right: 10px;
        font-weight: 700;
        font-size: 12px;
        cursor: pointer;
        font-family: 'Quicksand', sans-serif;
    }

    /* Scrollbar Ijo */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #ecfdf5; }
    ::-webkit-scrollbar-thumb { background: #15803d; border-radius: 10px; }

</style>
</head>

<body>

    <div class="w-full max-w-2xl bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl border-4 border-ijo-border p-6 md:p-8 relative">
        
        <div class="absolute top-0 right-0 -mt-3 -mr-3 bg-ijo-btn text-white text-xs font-bold px-4 py-1 rounded-full shadow-md transform rotate-12">
            Admin Form
        </div>

        <div class="flex items-center justify-between mb-6 border-b-2 border-dashed border-green-200 pb-4">
            <div>
                <h2 class="text-2xl font-bold text-ijo-btn">🌿 Input Data</h2>
                <p class="text-xs text-green-600 font-semibold">Semua kolom wajib diisi ya!</p>
            </div>
            <a href="list.php" class="text-xs font-bold text-green-600 hover:text-white hover:bg-green-600 border-2 border-green-600 px-3 py-1.5 rounded-lg transition-all">
                Kembali
            </a>
        </div>

        <form method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="md:col-span-2">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" required class="form-input" placeholder="...">
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" required class="form-input">
            </div>

            <div>
                <label>No HP</label>
                <input type="number" name="no_hp" required class="form-input">
            </div>

            <div>
                <label>NIK</label>
                <input type="number" name="nik" required class="form-input">
            </div>

            <div>
                <label>NIP</label>
                <input type="text" name="nip" required class="form-input">
            </div>

            <div>
                <label>Status</label>
                <div class="custom-select-wrapper">
                    <select name="status" class="real-select hidden">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                    <div class="custom-select">
                        <div class="custom-select-trigger">
                            <span>Pilih Status</span>
                            <div class="arrow"></div>
                        </div>
                        <div class="custom-options">
                            <div class="custom-option" data-value="aktif">Aktif</div>
                            <div class="custom-option" data-value="nonaktif">Nonaktif</div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" required class="form-input">
            </div>

            <div>
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required class="form-input">
            </div>

            <div>
                <label>Jenis Kelamin</label>
                <div class="custom-select-wrapper">
                    <select name="jenis_kelamin" class="real-select hidden">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <div class="custom-select">
                        <div class="custom-select-trigger">
                            <span>Pilih Gender</span>
                            <div class="arrow"></div>
                        </div>
                        <div class="custom-options">
                            <div class="custom-option" data-value="L">Laki-laki</div>
                            <div class="custom-option" data-value="P">Perempuan</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label>Alamat</label>
                <textarea name="alamat" rows="2" required class="form-input resize-none"></textarea>
            </div>

            <div>
                <label>Jabatan</label>
                <div class="custom-select-wrapper">
                    <select name="id_jabatan" class="real-select hidden" required>
                        <option value="">Pilih Jabatan</option>
                        <?php
                        $q = mysqli_query($conn, "SELECT id_jabatan, nama_jabatan FROM jabatan");
                        while ($j = mysqli_fetch_assoc($q)){
                            echo "<option value='{$j['id_jabatan']}'>{$j['nama_jabatan']}</option>";
                        }
                        ?>
                    </select>
                    <div class="custom-select">
                        <div class="custom-select-trigger">
                            <span>Pilih Jabatan</span>
                            <div class="arrow"></div>
                        </div>
                        <div class="custom-options">
                            <?php
                            mysqli_data_seek($q, 0); 
                            while ($j = mysqli_fetch_assoc($q)){
                                echo "<div class='custom-option' data-value='{$j['id_jabatan']}'>{$j['nama_jabatan']}</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label>Departemen</label>
                <div class="custom-select-wrapper">
                    <select name="id_departement" class="real-select hidden" required>
                        <option value="">Pilih Departemen</option>
                        <?php
                        $q2 = mysqli_query($conn, "SELECT id_departement, nama_departement FROM departement");
                        while ($d = mysqli_fetch_assoc($q2)){
                            echo "<option value='{$d['id_departement']}'>{$d['nama_departement']}</option>";
                        }
                        ?>
                    </select>
                    <div class="custom-select">
                        <div class="custom-select-trigger">
                            <span>Pilih Departemen</span>
                            <div class="arrow"></div>
                        </div>
                        <div class="custom-options">
                            <?php
                            mysqli_data_seek($q2, 0);
                            while ($d = mysqli_fetch_assoc($q2)){
                                echo "<div class='custom-option' data-value='{$d['id_departement']}'>{$d['nama_departement']}</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label>Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" required class="form-input">
            </div>

            <div>
                <label>Photo KTP</label>
                <input type="file" name="photo_ktp" required class="form-input" style="padding: 6px;">
            </div>

            <div>
                <label>Foto Selfie</label>
                <input type="file" name="foto_selfie" required class="form-input" style="padding: 6px;">
            </div>

            <div class="md:col-span-2 mt-4 pt-2">
                <button type="submit" name="simpan"
                    class="w-full bg-ijo-btn hover:bg-green-900 text-white font-bold py-3 rounded-xl shadow-[0_4px_0_rgb(5,46,22)] active:shadow-none active:translate-y-1 transition-all">
                    💾 SIMPAN DATA
                </button>
            </div>

        </form>
    </div>

    <script>
        document.querySelectorAll('.custom-select-wrapper').forEach(wrapper => {
            const select = wrapper.querySelector('.custom-select');
            const trigger = select.querySelector('.custom-select-trigger');
            const triggerText = trigger.querySelector('span');
            const options = select.querySelectorAll('.custom-option');
            const realSelect = wrapper.querySelector('.real-select');

            trigger.addEventListener('click', (e) => {
                document.querySelectorAll('.custom-select').forEach(el => {
                    if (el !== select) el.classList.remove('open');
                });
                select.classList.toggle('open');
                e.stopPropagation();
            });

            options.forEach(option => {
                option.addEventListener('click', function() {
                    triggerText.textContent = this.textContent;
                    realSelect.value = this.getAttribute('data-value');
                    options.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    select.classList.remove('open');
                });
            });

            window.addEventListener('click', (e) => {
                if (!select.contains(e.target)) select.classList.remove('open');
            });
        });
    </script>

</body>
</html>