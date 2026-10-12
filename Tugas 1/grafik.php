<?php
session_start();
if (!isset($_SESSION["nama"])) { header("Location: login.php"); exit; }
require_once "koneksi.php";

$judul   = "Grafik";
$halaman = "grafik";

// Grafik 1: jumlah pesan per tanggal
$label1 = []; $data1 = [];
$rows = $pdo->query("SELECT DATE(tanggal) AS hari, COUNT(*) AS jumlah
                     FROM pesan GROUP BY DATE(tanggal) ORDER BY hari")->fetchAll();
foreach ($rows as $r) {
    $label1[] = $r["hari"];
    $data1[]  = (int)$r["jumlah"];
}

// Grafik 2: panjang pesan (jumlah karakter) per pengirim
$label2 = []; $data2 = [];
$rows = $pdo->query("SELECT nama, CHAR_LENGTH(pesan) AS panjang
                     FROM pesan ORDER BY panjang DESC")->fetchAll();
foreach ($rows as $r) {
    $label2[] = $r["nama"];
    $data2[]  = (int)$r["panjang"];
}

require "header.php";
?>

<section class="section">
    <div class="container">
        <h2 class="section-title">Grafik Pesan Fans</h2>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card card-irul p-4">
                    <h5 class="mb-3">Jumlah pesan per tanggal</h5>
                    <canvas id="grafikTanggal"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-irul p-4">
                    <h5 class="mb-3">Panjang pesan per pengirim</h5>
                    <canvas id="grafikPanjang"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById("grafikTanggal"), {
    type: "bar",
    data: {
        labels: <?= json_encode($label1) ?>,
        datasets: [{
            label: "Jumlah pesan",
            data: <?= json_encode($data1) ?>,
            backgroundColor: "#c25b85",
            borderRadius: 8
        }]
    },
    options: { scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});

new Chart(document.getElementById("grafikPanjang"), {
    type: "bar",
    data: {
        labels: <?= json_encode($label2) ?>,
        datasets: [{
            label: "Jumlah karakter",
            data: <?= json_encode($data2) ?>,
            backgroundColor: "#a2446b",
            borderRadius: 8
        }]
    },
    options: { indexAxis: "y", scales: { x: { beginAtZero: true } } }
});
</script>

<?php require "footer.php"; ?>