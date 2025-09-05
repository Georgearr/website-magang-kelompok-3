-- SQL Script ini untuk setup database Malam Keakraban OSIS
-- Jalankan script ini di MySQL database Anda

-- Buat database (sesuaikan nama jika diperlukan)
CREATE DATABASE IF NOT EXISTS malam_keakraban;
USE malam_keakraban;

-- Buat tabel untuk pendaftaran lomba
CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    class VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255),
    team_name VARCHAR(255),
    team_members TEXT,
    competition VARCHAR(255) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_competition (competition),
    INDEX idx_registration_date (registration_date)
);

-- Insert contoh data (opsional)
-- INSERT INTO registrations (name, class, phone, email, team_name, team_members, competition) 
-- VALUES ('Contoh Peserta', 'XII IPA 1', '081234567890', 'contoh@email.com', 'Tim Contoh', 'Anggota 1, Anggota 2', 'band-fanatix');

-- Tampilkan struktur tabel
DESCRIBE registrations;