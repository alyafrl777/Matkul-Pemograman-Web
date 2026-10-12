<?php
require_once "cek_login.php";
require_once "koneksi.php";

// Read: ambil semua pesan, yang terbaru di atas
$daftarPesan = $pdo->query("SELECT * FROM pesan ORDER BY id DESC")->fetchAll();

// pesan notifikasi setelah tambah / edit / hapus
$notif = [
    "tersimpan" => "Pesanmu sudah terkirim. Terima kasih!",
    "diubah"    => "Pesan berhasil diperbarui.",
    "dihapus"   => "Pesan berhasil dihapus.",
];
$status = $_GET["status"] ?? "";

$judul   = "Pesan Fans";
$halaman = "pesan";
$skrip   = "js/pesan.js";
require_once "header.php";
?>

<div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <h1 class="h3 fw-bold mb-0">Pesan untuk Irul</h1>
        <a href="tambah.php" class="btn btn-irul"><i class="bi bi-plus-lg"></i> Tulis pesan</a>
    </div>

    <?php if (isset($notif[$status])): ?>
        <div class="alert alert-success"><?= $notif[$status] ?></div>
    <?php endif; ?>

    <div class="card card-irul">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:60px">No</th>
                        <th style="width:180px">Nama</th>
                        <th>Pesan</th>
                        <th style="width:170px">Tanggal</th>
                        <th style="width:160px" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarPesan)): ?>
                        <tr><td colspan="5" class="text-center py-4">Belum ada pesan. Jadilah yang pertama menulis untuk Irul!</td></tr>
                    <?php endif; ?>

                    <?php $no = 1; foreach ($daftarPesan as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($p["nama"]) ?></td>
                        <td><?= nl2br(htmlspecialchars($p["pesan"])) ?></td>
                        <td class="small"><?= date("d M Y, H:i", strtotime($p["tanggal"])) ?></td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="edit.php?id=<?= $p["id"] ?>" class="btn btn-sm btn-outline-irul">Edit</a>
                                <form method="POST" action="hapus.php" class="form-hapus">
                                    <input type="hidden" name="id" value="<?= $p["id"] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require_once "footer.php"; ?>