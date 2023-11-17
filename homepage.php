<?php
require("koneksi.php");
session_start();
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
                <li style="float:right"><a href="profile.php"><img src="Assets/profil.png" style="height: 25px; width: 25px;"></a></li>
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
    <main>
        <!-- Your main content goes here -->
    </main>
</body>
</html>
