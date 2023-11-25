<?php
session_start();
require("koneksi.php");

function selamatdatang() {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<li style="float:left">Selamat datang, ' . $username . '</li>';
    }
}

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

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Film</title>
    <style>
        header {
            text-align: right;
        
        }
      
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav a {
            text-decoration: none;
            color: black;
        }

    </style>
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="movielist.php">Movie List</a></li>
                <li><a href="watchlist.php">Watch List</a></li>

                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $query = "SELECT role FROM user WHERE username = '$username'";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $role = $row['role'];

                        if ($role === 'admin') {
                            echo '<li><a href="manageakun.php">Manajemen Akun</a></li>';
                        }
                    }
                }
                ?>
                <li style="float:right"><a href="profil.php"><img src="Assets/profil.png" style="height: 25px; width: 25px;"></a></li>
                <?php
                selamatdatang();
                ?>
                 <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <h2>Tambah Film</h2>
    <form method="POST" action="tambahfilm.php" enctype="multipart/form-data">
        <label for="id_film">ID Film:</label>
        <input type="number" id="id_film" name="id_film" required><br>
        <label for="nama_film">Judul Film:</label>
        <input type="text" id="nama_film" name="nama_film" required><br>

        <label for="gambar_film">Gambar Film:</label>
        <input type="file" name="gambar_film" id="gambar_film" accept="image/*" required><br>

        <label for="deskripsi_film">Deskripsi Film:</label>
        <textarea id="deskripsi_film" name="deskripsi_film" required></textarea><br>

        <label for="tahun">Tahun:</label>
        <input type="number" id="tahun" name="tahun" required><br>

        <label for="direktor">Direktor:</label>
        <input type="text" id="direktor" name="direktor" required><br>

        <label for="writer">Writer:</label>
        <input type="text" id="writer" name="writer" required><br>

        <label for="stars">Stars:</label>
        <input type="text" id="stars" name="stars" required><br>

        <label> for="durasi">Durasi:</label>
        <input type="text" id="durasi" name="durasi" required><br>

        <button type="submit">Tambah Film</button>

    </form>
<br>
    <a href="movielist.php">Kembali</a><br><br>


</body>
</html>
