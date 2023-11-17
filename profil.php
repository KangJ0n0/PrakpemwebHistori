<?php
session_start();
require("koneksi.php");

// Periksa apakah pengguna sudah masuk (sesi ada)
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

// Ambil data pengguna dari tabel user berdasarkan username sesi
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $id_user = $row['id_user'];
    $email = $row['email'];
    $username = $row['username'];
    $password = $row['password'];
    $role = $row['role'];
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
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
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo '<li style="float:left">Selamat datang, ' . $username . '</li>';
                }
                ?>
                 <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class = "dataprofil">
        <h2>Profil Pengguna</h2>
    <p><strong>ID User:</strong> <?php echo $id_user; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Username:</strong> <?php echo $username; ?></p>
    <p><strong>Password:</strong> <?php echo $password; ?></p>
    <p><strong>Role:</strong> <?php echo $role; ?></p>
    </div>
</body>
</html>
