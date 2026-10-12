<?php
require_once "cek_login.php";

$judul   = "Beranda";
$halaman = "beranda";
$skrip   = "js/beranda.js";

// popup sambutan hanya muncul sekali, tepat setelah login
$sapa = !empty($_SESSION["baru_login"]);
unset($_SESSION["baru_login"]);

require_once "header.php";
?>

<!-- ============ HERO ============ -->
<header class="hero" id="atas">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7 order-2 order-lg-1">
                <p class="hero-sub mb-2">LNGSHOT &bull; MORE VISION</p>
                <h1 class="hero-title">Irfan Pratama<br>(Irul)</h1>
                <p class="lead mb-4">Rapper LNGSHOT yang keren dan swag parahhh. Selamat datang di rumah kecil untuk para Shotties.</p>
                <a href="#profil" class="btn btn-irul btn-lg me-2">Kenali Irul</a>
                <a href="#playlist" class="btn btn-outline-irul btn-lg">Dengar playlist</a>
            </div>
            <div class="col-lg-5 order-1 order-lg-2">
                <div class="foto-frame mx-auto">
                    <img src="gambar/irul ilove.png" alt="Irul I Love" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</header>

<!-- ============ PROFIL ============ -->
<section class="section" id="profil">
    <div class="container">
        <h2 class="section-title">Who is Irul??</h2>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card card-irul h-100">
                    <div class="card-body p-4">
                        <p>
                            Kim Ryul atau biasa dipanggil oleh Shotties Irul merupakan member boy group LNGSHOT
                            di bawah naungan agensi MORE VISION.
                        </p>
                        <p>
                            Irul lahir pada 18 September 2006 dengan posisi di grup sebagai rapper.
                        </p>
                        <p class="mb-0">
                            Irul termasuk salah satu bias saya di LNGSHOT. Alasan jadi bias?? Beliau orangnya keren dan swag parahhh.. xixixi
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-irul h-100">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between"><span>Panggilan</span><strong>Irul</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Grup</span><strong>LNGSHOT</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Agensi</span><strong>MORE VISION</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Posisi</span><strong>Rapper</strong></li>
                        <li class="list-group-item d-flex justify-content-between"><span>Lahir</span><strong>18 September 2006</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ IRUL'S MOMENTS ============ -->
<section class="section section-tint" id="moments">
    <div class="container">
        <h2 class="section-title">Irul's Moments</h2>
        <div class="swiper irul-swiper rounded-4 shadow overflow-hidden mx-auto">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="gambar/MBG IRUL.png"  alt="Irul moment 1" onclick="bukaFoto(this.src)" class="w-100"></div>
                <div class="swiper-slide"><img src="gambar/MBG IRUL2.png" alt="Irul moment 2" onclick="bukaFoto(this.src)" class="w-100"></div>
                <div class="swiper-slide"><img src="gambar/MBG IRUL3.png" alt="Irul moment 3" onclick="bukaFoto(this.src)" class="w-100"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <p class="text-center mt-3 mb-0">Klik foto untuk memperbesar.</p>
    </div>
</section>

<!-- ============ PLAYLIST ============ -->
<section class="section" id="playlist">
    <div class="container text-center">
        <h2 class="section-title">If Irul were a song, what would he sound like? 🎀</h2>
        <img src="gambar/irul selca.jpg" alt="Irul Selca" class="selca shadow mb-3">
        <p class="mx-auto" style="max-width:520px">
            A small collection of songs that remind me of his vibe, those moments, and the feelings he gave me.
        </p>
        <a href="https://open.spotify.com/playlist/6ttA0SohNHxE0O9QHdctuD?si=7obmf2cLRkiC2ty92G09vg"
           target="_blank" rel="noopener noreferrer" class="btn btn-irul rounded-pill px-4">
            Dengarkan di Spotify
        </a>
    </div>
</section>

<?php require_once "footer.php"; ?>