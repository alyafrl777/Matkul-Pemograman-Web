<?php
session_start();
if (!isset($_SESSION["nama"])) { header("Location: login.php"); exit; }
require_once "koneksi.php";
require "vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Pesan Fans");

// judul kolom
$sheet->fromArray(["No", "Nama", "Pesan", "Tanggal"], null, "A1");

// isi data
$data  = $pdo->query("SELECT * FROM pesan ORDER BY id")->fetchAll();
$baris = 2;
$no    = 1;
foreach ($data as $r) {
    $sheet->fromArray([$no++, $r["nama"], $r["pesan"], $r["tanggal"]], null, "A$baris");
    $baris++;
}

// judul tebal & lebar kolom otomatis
$sheet->getStyle("A1:D1")->getFont()->setBold(true);
foreach (range("A", "D") as $kolom) {
    $sheet->getColumnDimension($kolom)->setAutoSize(true);
}

// kirim sebagai unduhan
$tipe = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
header("Content-Type: $tipe");
header('Content-Disposition: attachment; filename="pesan_fans.xlsx"');
header("Cache-Control: max-age=0");

$writer = new Xlsx($spreadsheet);
$writer->save("php://output");
exit;