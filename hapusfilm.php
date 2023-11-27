<?php
session_start();
require("koneksi.php");

function Welcome() {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<li style="float:left">Welcome, ' . $username . '</li>';
    }
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT role FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];

        if ($role !== 'admin') {
            header("Location: homepage.php");
            exit();
        }
    }
} else {
    header("Location: homepage.php"); 
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_film = $_POST['id_film'];

    $query_delete = "DELETE FROM film WHERE id_film='$id_film'";
    $result_delete = mysqli_query($conn, $query_delete);

    if ($result_delete) {
        echo '<script><alert>Film data success deletedQ.</alert></script>';
        header("Location: movielist.php");
        exit(); 
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete List</title>
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

    <h2></h2>

    <?php
    // Ambil id_film dari parameter URL
    $id_film = $_GET['id_film'];
    $query_select = "SELECT * FROM film WHERE id_film='$id_film'";
    $result_select = mysqli_query($conn, $query_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
    } else {
        echo "Can't find film data.";
        exit();
    }
    ?>

    <div class="film">
        <img src="<?php echo $row['gambar_film']; ?>" alt="gambarfilm">
        <p><?php echo $row['nama_film']; ?></p> 
    </div>

    <form method="POST" action="hapusfilm.php">
        <input type="hidden" name="id_film" value="<?php echo $row['id_film']; ?>">
        <p>Want to delete this film data?</p>
        <button type="submit">Delete</button>
    </form>


</body>
</html>
