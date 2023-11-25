<?php
session_start();
require("koneksi.php");

function Welcome() {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<li style="float:left">Welcome, ' . $username . '</li>';
    }
}
// Periksa apakah pengguna sudah masuk (sesi ada)
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

// Ambil data pengguna dari tabel user berdasarkan username sesi
function getUserData() {
    global $conn;

    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row; // Mengembalikan seluruh data pengguna
    } else {
        return false;
    }
}

// Memanggil fungsi untuk mendapatkan data pengguna
$userData = getUserData();

// Menetapkan nilai variabel untuk email dan username
$email = $userData['email'];
$username = $userData['username'];
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
        .dataprofil {
            text-align: justify;
            margin-top: 40px;
            margin-left: 30px;
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
                Welcome();
                ?>
                 <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class = "dataprofil">
        <h2>Profil Pengguna</h2>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Username:</strong> <?php echo $username; ?></p>
    </div>
</body>
</html>
