<?php
session_start();
if (!isset($_SESSION["nama"])) { header("Location: login.php"); exit; }
require_once "koneksi.php";

$judul   = "Export";
$halaman = "export";

$data  = $pdo->query("SELECT * FROM pesan ORDER BY id")->fetchAll();
$total = count($data);

require "header.php";
?>

<section class="section">
    <div class="container">
        <h2 class="section-title">Export Data Pesan Fans</h2>

        <div class="text-center mb-4">
            <a href="export_excel.php" class="btn btn-irul btn-lg">
                <i class="bi bi-file-earmark-excel"></i> Download Excel
            </a>
        </div>

        <div class="card card-irul p-3">
            <p class="mb-2 text-center"><strong>Preview data</strong> (<?= $total ?> pesan)</p>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>ID</th><th>Nama</th><th>Pesan</th><th>Tanggal</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $r): ?>
                        <tr>
                            <td><?= $r["id"] ?></td>
                            <td><?= htmlspecialchars($r["nama"]) ?></td>
                            <td><?= htmlspecialchars($r["pesan"]) ?></td>
                            <td><?= $r["tanggal"] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php require "footer.php"; ?>