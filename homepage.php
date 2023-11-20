<?php
require("koneksi.php");
session_start();
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/homepage.css">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    <title>Homepage</title>
</head>
<body>
    <header>
        <nav>
            <ul class="navbar">
                <li><a href="homepage.php" class="page">Home</a></li>
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
                <li style="float:right"><a href="profil.php"><img src="Assets/home/user 1.png" class="profil"></a></li>
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
    <div class="container">
    <div class="text">
    <h1>Selamat Datang!</h1>
    <div class="text2"><p>Di setiap detik, film sejarah mengukir kejayaan yang tak terlupakan.</p>
    <a href="movielist.php"><img src="assets/home/history movies.png" class="history"></a></div>
            </div>
            </div>
</body>
</html>
