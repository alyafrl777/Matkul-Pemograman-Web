<?php
// hapus.php : Delete (DELETE). Tidak punya tampilan, hanya memproses lalu pindah halaman.
require_once "cek_login.php";
require_once "koneksi.php";

// hanya menerima permintaan POST (dari tombol Hapus), bukan dari alamat yang diketik
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) ($_POST["id"] ?? 0);

    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM pesan WHERE id = ?");
        $stmt->execute([$id]);
    }
}

header("Location: pesan.php?status=dihapus");
exit;