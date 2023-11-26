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
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="css/watchlist.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
</head>
<body>
<nav>
    <header>
            <ul>
                <input type="text" placeholder="Search..">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="movielist.php">Movie List</a></li>
                <li><a href="watchlist.php" class="page">Watch List</a></li>

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
                 <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
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
    <div class="center">
        <div class="kotak">
        <?php
// Periksa session username
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query untuk mengambil course yang sudah disimpan oleh pengguna
    $sql = "SELECT c.gambar_film, c.id_film, c.nama_film, c.tahun
    FROM film AS c
    JOIN myfilm AS m ON c.id_film = m.id_film
    WHERE m.id_user = (SELECT id_user FROM user WHERE username = '$username')";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="film">';
        echo '
        <table>
            <tr align="center">
                <td><a href="detailfilm.php?id_film=' . $row["id_film"] . '"><img src="' . $row["gambar_film"] . '" alt="gambarfilm"></a></td>
            </tr>
            <tr align="center">
                <td><a href="detailfilm.php?id_film=' . $row["id_film"] . '">'. $row['nama_film'].'</a></td>
            </tr>
            <tr align="center">
                <td><a class="tahun" href="detailfilm.php?id_film=' . $row["id_film"] . '">('. $row['tahun'].')</a></td>
            </tr>
        </table>';
        echo '</div>';
    }
    
} else {
    echo "Login first";
}
?>

<script>
    function deleteFilm(id_film) {
        var confirmation = confirm("Delete this film from watchlist");
        if (confirmation) {
            window.location.href = "hapuswatchlist.php?id=" + id_film;
        }
    }
</script>

        </div>
    </div>
</body>
</html>