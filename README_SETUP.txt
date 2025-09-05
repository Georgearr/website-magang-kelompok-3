INSTRUKSI SETUP WEBSITE MALAM KEAKRABAN OSIS
=====================================================

PERSYARATAN SISTEM:
- Web server dengan PHP 8.2 atau lebih baru
- MySQL Database
- Browser modern (Chrome, Firefox, Safari, Edge)

LANGKAH-LANGKAH SETUP:

1. SETUP DATABASE MYSQL
   a. Buka MySQL (phpMyAdmin, MySQL Workbench, atau command line)
   b. Jalankan script SQL dari file "database_setup.sql"
   c. Pastikan database "malam_keakraban" berhasil dibuat
   d. Tabel "registrations" harus sudah terbuat

2. KONFIGURASI DATABASE
   a. Buka file "config.php"
   b. Sesuaikan pengaturan database:
      - $servername = "localhost"; (atau IP server MySQL Anda)
      - $username = "root"; (atau username MySQL Anda)
      - $password = ""; (masukkan password MySQL Anda)
      - $dbname = "malam_keakraban"; (nama database)

3. STRUKTUR FILE WEBSITE
   - index.html          -> Halaman utama website
   - style.css           -> Styling utama
   - competition.css     -> Styling halaman kompetisi
   - script.js           -> JavaScript interaktif
   - competition.php     -> Halaman detail lomba dan form pendaftaran
   - admin.php           -> Panel admin untuk melihat pendaftaran
   - config.php          -> Konfigurasi database
   - database_setup.sql  -> Script setup database

4. MENJALANKAN WEBSITE
   a. Pastikan server web (Apache/Nginx) dan MySQL sudah running
   b. Upload semua file ke direktori web server
   c. Akses website melalui browser
   d. Test dengan mendaftar salah satu lomba

5. PANEL ADMIN
   - Akses: yourwebsite.com/admin.php
   - Password default: admin123
   - PENTING: Ganti password di file admin.php baris 8

6. FITUR WEBSITE
   - Halaman utama dengan informasi acara
   - 21 kartu lomba sesuai gambar yang diberikan
   - Klik kartu untuk melihat detail dan form pendaftaran
   - Form pendaftaran tersimpan ke database MySQL
   - Panel admin untuk melihat data pendaftaran

TROUBLESHOOTING:
- Jika error koneksi database: Cek config.php dan status MySQL
- Jika tampilan tidak sesuai: Pastikan file CSS ter-load dengan benar
- Jika form tidak submit: Cek permission file PHP dan database

KEAMANAN:
- Ganti password admin di admin.php
- Jika untuk produksi, tambahkan validasi dan sanitasi input
- Gunakan HTTPS untuk keamanan data

Support: Website ini dibuat dengan HTML, CSS, JavaScript, dan PHP
sesuai permintaan untuk acara Malam Keakraban OSIS.