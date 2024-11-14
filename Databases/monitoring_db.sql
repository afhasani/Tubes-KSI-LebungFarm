-- Buat database baru
CREATE DATABASE IF NOT EXISTS monitoring_db;

-- Gunakan database yang baru dibuat
USE monitoring_db;

-- Buat tabel kunjungan
CREATE TABLE IF NOT EXISTS kunjungan (
    tanggal DATE PRIMARY KEY,
    jumlah INT DEFAULT 1
);
