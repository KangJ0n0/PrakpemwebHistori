<?php
session_start();
require("koneksi.php");

function Welcome() {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<li style="float:left">Welcome, ' . $username . '</li>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Film</title>
    <link rel="stylesheet" type="text/css" href="css/tambahfilm.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
</head>
<body>
    <div class="center">
<table>
    <tr>
        <td>
            <div class="mywatch">
                <h1>My Watchlist</h1>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="shape"></div>
        </td>
    </tr>
    </table>
</div>
<div class="tengah">
    <div class="table">
    <table>
    <form method="POST" action="tambahfilm.php" enctype="multipart/form-data">
        <tr>
            <td><label for="id_film">ID Film</label></td>
            <td colspan="2"><input type="number" id="id_film" name="id_film" required></td>
        </tr>
        <tr>
            <td><label for="nama_film">Title</label></td>
            <td colspan="2"><input type="text" id="nama_film" name="nama_film" required></td>
        </tr>
        <tr>
            <td><label for="tahun">Year</label></td>
            <td colspan="2"><input type="number" id="tahun" name="tahun" required></td>
        </tr>
        <tr>
            <td><label for="durasi">Duration</label></td>
            <td colspan="3"><input type="text" id="durasi" name="durasi" required></td>
        </tr>
        <tr>
            <td><label for="direktor">Directors</label></td>
            <td colspan="2"><input type="text" id="direktor" name="direktor" required></td>
        </tr>
        <tr>
            <td><label for="writer">Writers</label></td>
            <td colspan="2"><input type="text" id="writer" name="writer" required></td>
        </tr>
        <tr>
            <td><label for="stars">Stars</label></td>
            <td colspan="2"><input type="text" id="stars" name="stars" required></td>
        </tr>
        <tr>
            <td><label for="gambar_film">Poster picture</label></td>
            <td colspan="2"><label for="upload" class="upload">Upload Image</label><input type="file" name="gambar_film" id="gambar_film" accept="image/*" class="file" required></td>
        </tr>
        <tr>
            <td><label for="deskripsi_film">Film Description</label></td>
            <td class="kecil"><textarea id="deskripsi_film" name="deskripsi_film" required></textarea></td>
            <td><button type="submit">Add film</button><br><button onclick="cancel()">cancel</button></td>
            <script>
                function cancel() {
                window.history.back();
                }
            </script>
        </tr>
        <tr>
            <td><td>
        </tr>
        </form>
    </table>
</form>
</div>
</div>


</body>
</html>

<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT role FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];

        if ($role !== 'admin') {
            header("Location: homepage.php"); // Redirect ke halaman utama jika bukan admin
            exit();
        }
    }
} else {
    header("Location: homepage.php"); 
    exit();
}

// Proses form jika ada data yang dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lakukan validasi data sesuai kebutuhan
    $id_film = $_POST['id_film'];
    $nama_film = $_POST['nama_film'];
    $deskripsi_film = $_POST['deskripsi_film'];
    $tahun = $_POST['tahun'];
    $direktor = $_POST['direktor'];
    $writer = $_POST['writer'];
    $stars = $_POST['stars'];
    $durasi = $_POST['durasi'];

    // Proses file gambar yang diunggah
    $target_dir = "assets/";
    $target_file = $target_dir . basename($_FILES["gambar_film"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["gambar_film"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo ", only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "File gagal di upload.";

    } else {
        if (move_uploaded_file($_FILES["gambar_film"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["gambar_film"]["name"])). " has been uploaded.";
            
            // Simpan data film ke database
            $gambar_film = "assets/" . basename($_FILES["gambar_film"]["name"]);
            $query_insert = "INSERT INTO film (id_film, nama_film, gambar_film, deskripsi_film, tahun, direktor, writer, stars, durasi) VALUES ('$id_film','$nama_film', '$gambar_film', '$deskripsi_film', '$tahun', '$direktor', '$writer', '$stars', '$durasi')";
            $result_insert = mysqli_query($conn, $query_insert);

            if ($result_insert) {
                echo '<script>if(!alert("List Film berhasil di tambahkan")) document.location = "movielist.php";
                            </script>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

