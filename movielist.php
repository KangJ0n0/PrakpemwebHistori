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
           width: 10%; 
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
    
    <?php
    $sql = "SELECT * FROM film";
    $result = $conn->query($sql);

    if ($role === 'admin') {
        echo '<li style = "text-align: center;"><a href="tambahfilm.php">Add Film list</a></li>';
    }

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="film">';
        echo '<a href="detailfilm.php?id_film=' . $row["id_film"] . '">';
        echo '<img src="' . $row["gambar_film"] . '" alt="gambarfilm">';
        echo '</div>';
      }
    } else {
      echo "No data.";
    }
    ?>
    
</body>
</html>
