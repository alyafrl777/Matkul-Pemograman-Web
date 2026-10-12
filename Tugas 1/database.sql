CREATE DATABASE IF NOT EXISTS db_fansite CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_fansite;

CREATE TABLE IF NOT EXISTS pesan (
  id      INT AUTO_INCREMENT PRIMARY KEY,
  nama    VARCHAR(50) NOT NULL,
  pesan   TEXT        NOT NULL,
  tanggal TIMESTAMP   DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO pesan (nama, pesan) VALUES
('Shotties 01', 'Semangat terus mas Irul, ditunggu comeback-nya btw sampein salamku ke adek louis!'),
('Shotties 02', 'senyum irul mewarnai hariku mhehehe.');

CREATE TABLE IF NOT EXISTS users (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50)  NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama     VARCHAR(100) NOT NULL
);