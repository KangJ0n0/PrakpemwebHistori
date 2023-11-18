<?php
session_start();
require("koneksi.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
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

        h1 {
            text-align: center;
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
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo '<li style="float:left">Selamat datang, ' . $username . '</li>';
                }
                ?>
                 <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>

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

        // Tampilkan data film
        echo "<h1>$nama_film</h1>";
        echo "<p style='text-align: left;'><a href='simpanfilm.php?id_film=$id_film'>Tambahkan ke Watch List</a></p>";
        echo "<img src='$gambar_film' alt='$nama_film'>";
        echo "<p>$deskripsi_film</p>";
    } else {
        echo "Data film tidak ditemukan.";
    }
} else {
    echo "ID film tidak valid.";
}
?>

