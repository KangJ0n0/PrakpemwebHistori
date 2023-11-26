<?php
session_start();
require("koneksi.php");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/detail.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    <title>Homepage</title>
</head>
<body>
<a href="#" id="back"><div class="arrow"><img src="../assets/arrow 1.png"></div></a>
    <script>
        document.getElementById("back").addEventListener("click", function() {
            history.back();
        });
    </script>
<?php

if (isset($_GET['id_film'])) {
    $id_film = $_GET['id_film'];

    // Ambil data film dari tabel film berdasarkan id_film
    $sql = "SELECT * FROM film WHERE id_film = $id_film";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_film = $row['nama_film'];
        $gambar_film = $row['gambar_film'];
        $deskripsi_film = $row['deskripsi_film'];
        $tahun = $row['tahun'];
        $durasi = $row['durasi'];
        $direktor = $row['direktor'];
        $writer = $row['writer'];
        $stars = $row['stars'];


        // Tampilkan data film
        echo "<div class='center'><div class='container'><p class='judul'>$nama_film</p>";
        echo "<p class='tahun'>$tahun $durasi</p>";
        echo 
        "<div class='deskripsi'>
        <table>
        <tr>
        <td rowspan='7'><img src='$gambar_film' alt='$nama_film' class='poster'></td>
        <tr>
        <td>Genre</td>
        </tr>
        <tr>
        <td><p class='overflow'>$deskripsi_film</p></td>
        </tr>
        <tr>
        <td class='cast'>Directors <p class='putih'>$direktor</p></td>
        </tr>
        <tr>
        <td class='cast'>Writers <p class='putih'>$writer</p></td>
        </tr>
        <tr>
        <td class='cast1'>Stars <p class='putih'>$stars</p></td>
        </tr>
        <tr>
        <td class='kotakadd'><a href='simpanfilm.php?id_film=$id_film'><div class='add'>Add to Watchlist</div></a></td>
        </tr>
        </table>
        
        
        </div>";
        } else {
        echo "Data film tidak ditemukan.";
    }
} else {
    echo "ID film tidak valid.";
}
?>
</body>
</html>

