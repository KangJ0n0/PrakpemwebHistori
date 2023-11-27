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
    <link rel="stylesheet" type="text/css" href="css/profil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">

</head>
<body>
    <a href="#" id="back"><div class="arrow"><img src="../assets/arrow 1.png"></div></a>
    <script>
        document.getElementById("back").addEventListener("click", function() {
            history.back();
        });
    </script>
    <div class="container">
    <div class = "dataprofil">
        <table>
            <tr>
                <td colspan="2" align="center"><h1><?php echo $username; ?></h1></td>
            </tr>
            <tr>
                <td colspan="2"  align="center"><div class="email"><input type="text" name="email" value="<?php echo $email; ?>" readonly></div><td>
            </tr>
            <tr>
                <td align="center" class="home"><input type="submit" value="home" name="home"></td>
                <td align="center" class="movielist"><input type="submit" value="movie list" name="movielist"></td>
            </tr>
            <tr>
                <td colspan="2" align="center" class="logout"><input type="submit" value="log out"></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
