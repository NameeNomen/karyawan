document.addEventListener("DOMContentLoaded", function() {
    // Kredensial hardcoded untuk demo
    const CRED = { user: 'admin', pass: 'admin123' };
    
    // Rute yang mau dikunjungin bot (sesuai sidebar lu)
    const tour = [
        'dashboard.php',
        'page/karyawan/list.php',
        'page/jabatan/list.php',
        'page/departement/list.php'
    ];

    // 1. LOGIKA LOGIN (Kalau ada di halaman login)
    if (window.location.href.includes('login.php')) {
        const userInput = document.querySelector('input[name="user"], input[type="text"]');
        const passInput = document.querySelector('input[name="pass"], input[type="password"]');
        const btn = document.querySelector('button[type="submit"], input[type="submit"]');

        if (userInput && passInput && btn) {
            userInput.value = CRED.user;
            passInput.value = CRED.pass;
            
            // Sedikit jeda biar kelihatan "ngetik"
            setTimeout(() => {
                btn.click();
            }, 800);
        }
    } 
    // 2. LOGIKA TOUR (Kalau sudah login)
    else {
        let step = parseInt(sessionStorage.getItem('tour_step') || '0');
        
        if (step < tour.length) {
            console.log("Bot: Pindah ke " + tour[step]);
            
            setTimeout(() => {
                sessionStorage.setItem('tour_step', step + 1);
                window.location.href = tour[step];
            }, 3000); // Tunggu 3 detik biar klien bisa liat menunya
        } else {
            sessionStorage.removeItem('tour_step');
        }
    }
});