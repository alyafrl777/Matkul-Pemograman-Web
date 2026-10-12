<?php
// edit.php : Update (UPDATE). Menerima id dari URL, contoh: edit.php?id=3
require_once "cek_login.php";
require_once "koneksi.php";

$id = (int) ($_GET["id"] ?? 0);

// 1. ambil data lama berdasarkan id
$stmt = $pdo->prepare("SELECT * FROM pesan WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

// kalau id tidak ada di database, kembali ke daftar
if (!$data) {
    header("Location: pesan.php");
    exit;
}

$error = "";
$nama  = $data["nama"];
$pesan = $data["pesan"];

// 2. proses saat tombol Simpan ditekan
if (isset($_POST["update"])) {
    $nama  = trim($_POST["nama"]);
    $pesan = trim($_POST["pesan"]);

    if ($nama === "" || $pesan === "") {
        $error = "Nama dan pesan wajib diisi.";
    } elseif (mb_strlen($nama) > 50) {
        $error = "Nama maksimal 50 karakter.";
    } elseif (mb_strlen($pesan) > 500) {
        $error = "Pesan maksimal 500 karakter.";
    } else {
        // jangan lupa WHERE, kalau tidak semua pesan ikut berubah
        $stmt = $pdo->prepare("UPDATE pesan SET nama = :nama, pesan = :pesan WHERE id = :id");
        $stmt->execute([":nama" => $nama, ":pesan" => $pesan, ":id" => $id]);
        header("Location: pesan.php?status=diubah");
        exit;
    }
}

$judul   = "Edit Pesan";
$halaman = "pesan";
require_once "header.php";
?>

<div class="container py-4" style="max-width:640px">
    <h1 class="h3 fw-bold mb-4">Edit pesan</h1>

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

                <button type="submit" name="update" class="btn btn-irul">Simpan perubahan</button>
                <a href="pesan.php" class="btn btn-outline-irul">Batal</a>
            </form>

        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>