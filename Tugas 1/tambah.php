<?php
// tambah.php : Create (INSERT). Logika di atas, tampilan di bawah.
require_once "cek_login.php";
require_once "koneksi.php";

$error = "";
$nama  = "";
$pesan = "";

if (isset($_POST["kirim"])) {
    $nama  = trim($_POST["nama"]);
    $pesan = trim($_POST["pesan"]);

    // validasi dulu sebelum disimpan
    if ($nama === "" || $pesan === "") {
        $error = "Nama dan pesan wajib diisi.";
    } elseif (mb_strlen($nama) > 50) {
        $error = "Nama maksimal 50 karakter.";
    } elseif (mb_strlen($pesan) > 500) {
        $error = "Pesan maksimal 500 karakter.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO pesan (nama, pesan) VALUES (:nama, :pesan)");
        $stmt->execute([":nama" => $nama, ":pesan" => $pesan]);
        header("Location: pesan.php?status=tersimpan");
        exit;
    }
}

$judul   = "Tulis Pesan";
$halaman = "pesan";
require_once "header.php";
?>

<div class="container py-4" style="max-width:640px">
    <h1 class="h3 fw-bold mb-4">Tulis pesan untuk Irul</h1>

    <div class="card card-irul">
        <div class="card-body p-4">

            <?php if ($error !== ""): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                           maxlength="50" required value="<?= htmlspecialchars($nama) ?>">
                </div>

                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan</label>
                    <textarea class="form-control" id="pesan" name="pesan"
                              rows="4" maxlength="500" required><?= htmlspecialchars($pesan) ?></textarea>
                </div>

                <button type="submit" name="kirim" class="btn btn-irul">Kirim pesan</button>
                <a href="pesan.php" class="btn btn-outline-irul">Batal</a>
            </form>

        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>