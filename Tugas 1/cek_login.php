<?php
// cek_login.php : penjaga halaman. Di-require di baris pertama setiap halaman yang harus login.
// JANGAN di-require di login.php (akan terjadi redirect berulang).
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;   // hentikan sisa halaman
}