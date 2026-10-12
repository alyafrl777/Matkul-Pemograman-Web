<?php
// login.php : form + proses login (tanpa cek_login.php)
session_start();
require_once "koneksi.php";

// sudah login? langsung ke beranda
if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST["login"])) {
    $username = trim($_POST["username"]);

    // 1. cari user berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();            // false jika tidak ditemukan

    // 2. cocokkan password dengan hash di database
    if ($user && password_verify($_POST["password"], $user["password"])) {
        session_regenerate_id(true);   // 3. session ID baru
        $_SESSION["user_id"] = $user["id"];       // 4. simpan ke session
        $_SESSION["nama"]    = $user["nama"];
        $_SESSION["baru_login"] = true;           // untuk popup sambutan di Beranda
        setcookie("username", $user["username"], time() + 60 * 60 * 24 * 7);   // ingat username 7 hari
        header("Location: index.php");
        exit;
    }
    // pesan dibuat sama agar penyerang tidak bisa menebak username yang terdaftar
    $error = "Username atau password salah!";
}

$u = $_POST["username"] ?? ($_COOKIE["username"] ?? "");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Irul Fansite</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex align-items-center" style="min-height:100vh">

<main class="container" style="max-width:420px">
    <div class="text-center mb-4">
        <p class="hero-sub mb-1">LNGSHOT &bull; MORE VISION</p>
        <h1 class="h2 fw-bold">Irul Fansite</h1>
        <p class="mb-0">Masuk dulu untuk lanjut.</p>
    </div>

    <div class="card card-irul">
        <div class="card-body p-4">

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                           value="<?= htmlspecialchars($u) ?>" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="login" class="btn btn-irul w-100">Login</button>
            </form>

        </div>
    </div>
</main>

</body>
</html>