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
                            echo '<li><a href="manageakun.php">Manage account</a></li>';
                        }
                    }
                }
                ?>
                <li style="float:right"><a href="profil.php"><img src="Assets/profil.png" style="height: 25px; width: 25px;"></a></li>
                <?php
                Welcome();
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
