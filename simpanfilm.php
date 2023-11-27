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

        $id_film = $_GET['id_film'];

        $checkQuery = "SELECT * FROM myfilm WHERE id_user = '$id_user' AND id_film = '$id_film'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo '<script>alert("Movie is already in your watchlist.");</script>';
        } else {
            $insertQuery = "INSERT INTO myfilm (id_user, id_film) VALUES ('$id_user', '$id_film')";
            if (mysqli_query($conn, $insertQuery)) {
                echo '<script>if(!alert("Add new watchlist success!")) document.location = "movielist.php";
                </script>';
            } else {
                echo "<script>alert('Can\'t save new watchlist: " . mysqli_error($conn) . "')</script>";
            }
        }
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "')</script>";
    }
} else {
    echo "<script>alert('Login first.')</script>";
}
?>
