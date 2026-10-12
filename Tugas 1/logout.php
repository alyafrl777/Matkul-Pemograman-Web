<?php
// logout.php : hapus session lalu kembali ke halaman login
session_start();
session_unset();      // kosongkan $_SESSION
session_destroy();    // hapus session di server
header("Location: login.php");
exit;