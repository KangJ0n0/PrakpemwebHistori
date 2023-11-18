<?php
// Koneksi ke database
require("koneksi.php");
session_start();

// Periksa session username
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT id_user FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $userRow = mysqli_fetch_assoc($result);
        $id_user = $userRow['id_user'];

        // Ambil ID Course dari parameter URL
        $id_film = $_GET['id_film'];

        // Periksa apakah pengguna sudah menyimpan course ini sebelumnya
        $checkQuery = "SELECT * FROM myfilm WHERE id_user = '$id_user' AND id_film = '$id_film'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "<script>alert('Film sudah ada di watchlist.')</script>";
            
        } else {
            // Jika pengguna belum menyimpan course ini, lakukan penyimpanan
            $insertQuery = "INSERT INTO myfilm (id_user, id_film) VALUES ('$id_user', '$id_film')";
            if (mysqli_query($conn, $insertQuery)) {
                echo "<script>alert('berhasil memasukan ke watchlist.')</script>";
            } else {
                echo "<script>alert('Gagal menyimpan course: " . mysqli_error($conn) . "')</script>";
            }
        }
    }
} else {
    echo "<script>alert('Anda harus login untuk menyimpan course.')</script>";
}
?>
