<footer class="footer text-center">
    <div class="container">
        <small>Fansite unofficial, ini tugas matkul pemrograman web.</small>
    </div>
</footer>
</main>

<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php if ($halaman === "beranda"): ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<?php endif; ?>

<script>
// buka/tutup sidebar (semua ukuran layar)
(function () {
    var sidebar = document.getElementById("sidebar");
    var lapisan = document.getElementById("lapisan");
    var konten  = document.getElementById("isiKonten");
    var tombol  = document.getElementById("tombolMenu");
    var ikon    = tombol.querySelector("i");

    function atur(buka) {
        sidebar.classList.toggle("terbuka", buka);
        lapisan.classList.toggle("terbuka", buka);
        konten.classList.toggle("geser", buka);
        ikon.className = buka ? "bi bi-x-lg" : "bi bi-list";
        try { localStorage.setItem("sidebarBuka", buka ? "1" : "0"); } catch (e) {}
    }

    tombol.addEventListener("click", function () {
        atur(!sidebar.classList.contains("terbuka"));
    });
    lapisan.addEventListener("click", function () { atur(false); });
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") atur(false);
    });

    // ingat pilihan terakhir (desktop saja)
    var simpan = null;
    try { simpan = localStorage.getItem("sidebarBuka"); } catch (e) {}
    if (simpan === "1" && window.innerWidth >= 768) atur(true);
})();
</script>

<?php if (!empty($skrip)): ?>
<script src="<?= htmlspecialchars($skrip) ?>"></script>
<?php endif; ?>

</body>
</html>