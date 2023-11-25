<?php
session_start();
require("koneksi.php");

function selamatdatang() {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<li style="float:left">Selamat datang, ' . $username . '</li>';
    }
}
$role = '';

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
          display: flex;
           width: 10%; /* Atur lebar div film seukuran dengan gambar */
             margin: 10px; /* Atur margin agar elemen terpisah dengan baik */
             
}

.film img {
    width: 100%; /* Gunakan 100% lebar untuk memenuhi div film */
    height: auto; /* Menjaga aspek ratio gambar */
    cursor: pointer;
}

.film:hover {
    transform: scale(1.1);
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
    
    <?php
    $sql = "SELECT * FROM film";
    $result = $conn->query($sql);

    if ($role === 'admin') {
        echo '<li style = "text-align: center;"><a href="tambahfilm.php">Tambah Film</a></li>';
    }


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
