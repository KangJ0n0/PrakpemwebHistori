<?php
require("koneksi.php");

if (isset($_GET['id'])) {
    $id_user_to_delete = $_GET['id'];

    // Query untuk menghapus user berdasarkan id_user
    $delete_user_query = "DELETE FROM user WHERE id_user = '$id_user_to_delete'";
    $delete_user_result = mysqli_query($koneksi, $delete_user_query);

    if ($delete_user_result) {
        // Redirect kembali ke halaman yang menampilkan data user setelah penghapusan
        header("Location: manageakun.php");
    } else {
        echo "Gagal menghapus user.";
    }
} else {
    echo "ID User tidak valid.";
}

mysqli_close($koneksi);
?>
