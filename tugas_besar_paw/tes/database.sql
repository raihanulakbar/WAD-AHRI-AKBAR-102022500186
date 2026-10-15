-- Import file ini lewat phpMyAdmin (tab "Import") atau jalankan di tab "SQL"
CREATE DATABASE IF NOT EXISTS db_perpustakaan
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_perpustakaan;

CREATE TABLE IF NOT EXISTS meja (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  nama_meja  VARCHAR(50) NOT NULL,
  lantai     TINYINT NOT NULL,
  wifi       ENUM('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  stopkontak ENUM('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  status     ENUM('Tersedia','Digunakan') NOT NULL DEFAULT 'Tersedia',
  gambar     VARCHAR(255) DEFAULT NULL
);

INSERT INTO meja (nama_meja, lantai, wifi, stopkontak, status, gambar) VALUES
('Meja 01', 1, 'Ya', 'Tidak', 'Tersedia',  'download.jpg'),
('Meja 02', 1, 'Ya', 'Ya',    'Digunakan', 'Shared Library Computer Tables that Offer Personal Space.jpg'),
('Meja 03', 2, 'Ya', 'Tidak', 'Tersedia',  'meja.jpg'),
('Meja 04', 2, 'Ya', 'Ya',    'Tersedia',  'Perpustakaan Kabupaten Pinrang.jpg');
