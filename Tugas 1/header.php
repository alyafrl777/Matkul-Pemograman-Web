<?php
// header.php : kerangka halaman (bagian <head> + sidebar).
// Sebelum di-require, halaman harus mengisi: $judul dan $halaman.
// Boleh juga: $skrip (file JS khusus halaman) dan $sapa (popup sambutan).

$menu = [
    "beranda" => ["label" => "Beranda",    "url" => "index.php",  "ikon" => "bi-house-door", "segera" => false],
    "pesan"   => ["label" => "Pesan Fans", "url" => "pesan.php",  "ikon" => "bi-chat-heart", "segera" => false],
    "grafik"  => ["label" => "Grafik",     "url" => "grafik.php", "ikon" => "bi-bar-chart",  "segera" => false],
    "export"  => ["label" => "Export",     "url" => "export.php", "ikon" => "bi-download",   "segera" => false],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($judul) ?> | Irul Fansite</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body<?= !empty($sapa) ? ' data-sapa="1"' : '' ?>>

<!-- tombol hamburger untuk buka/tutup sidebar -->
<button type="button" class="btn-sidebar" id="tombolMenu" aria-label="Buka/tutup menu">
    <i class="bi bi-list"></i>
</button>

<!-- ============ SIDEBAR ============ -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <span class="sidebar-sub">LNGSHOT &bull; MORE VISION</span>
        <span class="sidebar-judul">Irul Fansite</span>
    </div>

    <nav class="sidebar-menu">
        <?php foreach ($menu as $kode => $m): ?>
            <?php if ($m["segera"]): ?>
                <span class="sidebar-link nonaktif">
                    <i class="bi <?= $m["ikon"] ?>"></i> <?= $m["label"] ?> <small>segera</small>
                </span>
            <?php else: ?>
                <a href="<?= $m["url"] ?>" class="sidebar-link <?= $halaman === $kode ? "aktif" : "" ?>">
                    <i class="bi <?= $m["ikon"] ?>"></i> <?= $m["label"] ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </nav>

    <div class="sidebar-user">
        <div class="small">Masuk sebagai</div>
        <strong><?= htmlspecialchars($_SESSION["nama"]) ?></strong>
        <a href="logout.php" class="btn btn-sm btn-outline-light w-100 mt-2">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</aside>
<div class="sidebar-lapisan" id="lapisan"></div>

<main class="konten" id="isiKonten">