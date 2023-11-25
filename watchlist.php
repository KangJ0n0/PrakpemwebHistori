<?php
session_start();
require("koneksi.php");

function selamatdatang() {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<li style="float:left">Selamat datang, ' . $username . '</li>';
    }
}
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

        .film {
            width: 15%;
    display: flex;
    margin: 10px;
}

.film img {
    width: 100%; 
    height: auto; 
    cursor: pointer;
}

.film:hover {
    transform: scale(1.1);
}

    </style>

</head>
<body>
<nav>
    <header>
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
</body>
</html>

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
        echo '<a href="detailfilm.php?id_film=' . $row["id_film"] . '">';
        echo '<img src="' . $row['gambar_film'] . '" />';
        echo '</a>';
        echo '<div>';
        echo '<p>' . $row['nama_film'] . '</p>';
        echo '<p>(' . $row['tahun'] . ')</p>';
        echo '<a href="#" onclick="deleteFilm(' . $row['id_film'] . ')"> Hapus</a>';
        echo '</div>';
        echo '</div>';
    }
    
} else {
    echo "Anda harus login untuk melihat My Course.";
}
?>

<script>
    function deleteFilm(id_film) {
        var confirmation = confirm("Apakah Anda yakin ingin menghapus film ini dari Watch List?");
        if (confirmation) {
            window.location.href = "hapuswatchlist.php?id=" + id_film;
        }
    }
</script>
