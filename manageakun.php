<?php
session_start();
require('koneksi.php');



function selamatdatang() {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<li style="float:left">Selamat datang, ' . $username . '</li>';
    }
}



// Retrieve users with roles admin, manager, and user
$query_admin = "SELECT * FROM user WHERE role = 'admin'";
$query_user = "SELECT * FROM user WHERE role = 'user'";

$result_admin = mysqli_query($conn, $query_admin);
$result_user = mysqli_query($conn, $query_user);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    // Prevent deleting the user that is currently logged in
    if ($user_id != $_SESSION['id_user']) {
        $query_delete = "DELETE FROM user WHERE id_user = $user_id";
        if (mysqli_query($conn, $query_delete)) {
            header("Location: manageakun.php");
            exit();
        } else {
            echo "gagal hapus user: " . mysqli_error($conn);
        }
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
    <h2>Manajemen Akun</h2>

<h3>Admin</h3>
<table border="1">
    <tr>
        <th>ID User</th>
        <th>Email</th>
        <th>Username</th>
        <th>Password</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result_admin)) {
        echo "<tr>";
        echo "<td>" . $row['id_user'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<h3>User</h3>
<table border="1">
    <tr>
        <th>ID User</th>
        <th>Email</th>
        <th>Username</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result_user)) {
        echo "<tr>";
        echo "<td>" . $row['id_user'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>
                <form method='POST'>
                    <input type='hidden' name='user_id' value='" . $row['id_user'] . "'>
                    <input type='submit' name='delete_user' value='Hapus'>
                </form>
            </td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
