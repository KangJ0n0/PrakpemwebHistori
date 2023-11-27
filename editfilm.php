<?php
session_start();
require("koneksi.php");

function Welcome()
{
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

        h1 {
            text-align: center;
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
</body>

</html>

<?php

if (!isset($_SESSION['username'])) {
    echo "Login first.";
} else {
    $username = $_SESSION['username'];
    $query = "SELECT role FROM user WHERE username = '$username'";
    $roleResult = mysqli_query($conn, $query);

    if ($roleResult) {
        $roleRow = mysqli_fetch_assoc($roleResult);
        $role = $roleRow['role'];

        if ($role === 'admin') {

            $id_film = isset($_GET['id_film']) ? $_GET['id_film'] : null;

            if ($id_film === null) {
                echo "ID Film tidak valid.";
            } else {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $nama_film = $_POST['nama_film'];
                    $deskripsi_film = $_POST['deskripsi_film'];
                    $tahun = $_POST['tahun'];
                    $direktor = $_POST['direktor'];
                    $writer = $_POST['writer'];
                    $stars = $_POST['stars'];
                    $durasi = $_POST['durasi'];
                    $genre = isset($_POST['genre']) ? $_POST['genre'] : [];

                    $genre_string = implode(",", $genre);
                    $prev_genre = !empty($row['genre']) ? explode(",", $row['genre']) : [];

                    if ($_FILES["gambar_film"]["error"] == UPLOAD_ERR_OK) {
                        $target_dir = "assets/";
                        $target_file = $target_dir . basename($_FILES["gambar_film"]["name"]);

                        move_uploaded_file($_FILES["gambar_film"]["tmp_name"], $target_file);

                        $gambar_film = $target_file;
                    } else {
                        $gambar_film = $_POST['prev_gambar_film'];
                    }

                    // Using prepared statement to handle the update
                    $update_query = "UPDATE film SET nama_film=?, gambar_film=?, deskripsi_film=?, tahun=?, direktor=?, writer=?, stars=?, durasi=?, genre=? WHERE id_film=?";
                    $stmt = mysqli_prepare($conn, $update_query);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, 'sssssssssi', $nama_film, $gambar_film, $deskripsi_film, $tahun, $direktor, $writer, $stars, $durasi, $genre_string, $id_film);

                        // Execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            echo '<script>if(!alert("Update success")) document.location = "movielist.php";</script>';
                        } else {
                            echo "Error: " . mysqli_stmt_error($stmt);
                        }

                        // Close the prepared statement
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    $sql = "SELECT * FROM film WHERE id_film = '$id_film'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $prev_gambar_film = $row['gambar_film'];
                        $prev_genre = !empty($row['genre']) ? explode(",", $row['genre']) : [];
                        ?>
                        <form method="POST" action="" enctype="multipart/form-data">
                            Film name: <input type="text" name="nama_film" value="<?php echo $row['nama_film']; ?>"><br>
                            Poster picture:
                            <input type="file" name="gambar_film" id="gambar_film" accept="image/*">
                            <img src="<?php echo $prev_gambar_film; ?>" alt="Current Image" width="100"><br>
                            Film description: <textarea name="deskripsi_film"><?php echo $row['deskripsi_film']; ?></textarea><br>
                            Year release: <input type="number" name="tahun" value="<?php echo $row['tahun']; ?>"><br>
                            Directors: <input type="text" name="direktor" value="<?php echo $row['direktor']; ?>"><br>
                            Writers: <input type="text" name="writer" value="<?php echo $row['writer']; ?>"><br>
                            Stars: <input type="text" name="stars" value="<?php echo $row['stars']; ?>"><br>
                            Duration: <input type="text" name="durasi" value="<?php echo $row['durasi']; ?>"><br>
                            <label for="genre">Genre:</label>
                            <input type="checkbox" name="genre[]" value="History" <?php echo in_array('History', $prev_genre) ? 'checked' : ''; ?>> History
                            <input type="checkbox" name="genre[]" value="Action" <?php echo in_array('Action', $prev_genre) ? 'checked' : ''; ?>> Action
                            <input type="checkbox" name="genre[]" value="Biography" <?php echo in_array('Biography', $prev_genre) ? 'checked' : ''; ?>> Biography
                            <input type="checkbox" name="genre[]" value="Drama" <?php echo in_array('Drama', $prev_genre) ? 'checked' : ''; ?>> Drama
                            <input type="checkbox" name="genre[]" value="Romance" <?php echo in_array('Romance', $prev_genre) ? 'checked' : ''; ?>> Romance
                            <input type="checkbox" name="genre[]" value="Family" <?php echo in_array('Family', $prev_genre) ? 'checked' : ''; ?>> Family
                            <input type="checkbox" name="genre[]" value="War" <?php echo in_array('War', $prev_genre) ? 'checked' : ''; ?>> War
                            <br>

                            <input type="hidden" name="prev_gambar_film" value="<?php echo $prev_gambar_film; ?>">
                            <button type="submit">Save change</button>
                        </form>
                        <?php
                    } else {
                        echo 'No data.';
                    }
                }
            }
        } else {
            echo "You don't have authorization to edit this.";
        }
    }
}
?>
