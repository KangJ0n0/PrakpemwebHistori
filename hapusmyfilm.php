<?php
require("koneksi.php");
session_start();

// Periksa session username
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    // Periksa apakah parameter ID Film ada dalam URL
    if (isset($_GET['id'])) {
        $id_film = $_GET['id']; // Use the correct key here
        
        // Lakukan penghapusan film dari daftar "Watch List"
        $deleteQuery = "DELETE FROM myfilm WHERE id_user = (SELECT id_user FROM user WHERE username = '$username') AND id_film = '$id_film'";
        
        if (mysqli_query($conn, $deleteQuery)) {
            // Redirect kembali ke halaman "watchlist.php" setelah berhasil menghapus
            header("Location: watchlist.php");
        } else {
            echo "Gagal menghapus film: " . mysqli_error($conn);
        }
    } else {
        echo "ID Film tidak valid.";
    }
} else {
    echo "Anda harus login untuk menghapus film.";
}
?>
