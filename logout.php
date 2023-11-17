<?php
session_start();
session_destroy();

// Hapus cache halaman sebelumnya
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

header("location: index.php");
?>
