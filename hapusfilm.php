<?php
session_start();
require("koneksi.php");

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT role FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];

        if ($role !== 'admin') {
           
            header("Location: homepage.php");
            exit();
        }
    }
} else {

    header("Location: homepage.php");
    exit();
}

if (isset($_GET['id_film'])) {
    $id_film = $_GET['id_film'];

   
    $delete_query = "DELETE FROM film WHERE id_film = $id_film";
    $delete_result = $conn->query($delete_query);

    if ($delete_result) {
  
        header("Location: movielist.php");
        exit();
    } else {
       
        echo "Error deleting film: " . $conn->error;
    }
} else {
    echo "ID not provided for deletion.";
}
?>
