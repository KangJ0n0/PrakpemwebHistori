<?php
session_start();
require("koneksi.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="css/movielist.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <input type="text" placeholder="Search..">
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
                <li style="float:right"><a href="profil.php"><img src="assets/home/user 1.png" style="height: 25px; width: 25px;"></a></li>
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
    <?php
    $sql = "SELECT * FROM film";
    $result = $conn->query($sql);

    // Tampilkan data film
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="film">';
        echo '<a href="detailfilm.php?id_film=' . $row["id_film"] . '">';
        echo '<img src="' . $row["gambar_film"] . '" alt="gambarfilm">';
        echo '</div>';
      }
    } else {
      echo "Tidak ada data film.";
    }
    ?>
    
</body>
</html>
