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
    <title>Edit Film</title>
    <link rel="stylesheet" type="text/css" href="css/tambahfilm.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
</head>
<body>
</body>
</html>

<?php

if (!isset($_SESSION['username'])) {
    echo "Anda harus login untuk mengedit film.";
} else {
    $username = $_SESSION['username'];
    $query = "SELECT role FROM user WHERE username = '$username'";
    $roleResult = mysqli_query($conn, $query);

    if ($roleResult) {
        $roleRow = mysqli_fetch_assoc($roleResult);
        $role = $roleRow['role'];

        if ($role === 'admin') {
            // Ambil ID Film dari parameter URL
            $id_film = isset($_GET['id_film']) ? $_GET['id_film'] : null;

            if ($id_film === null) {
                echo "ID Film tidak valid.";
                // Handle the error or redirect the user
            } else {
                
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  
                    $nama_film = $_POST['nama_film'];
                    $deskripsi_film = $_POST['deskripsi_film'];
                    $tahun = $_POST['tahun'];
                    $direktor = $_POST['direktor'];
                    $writer = $_POST['writer'];
                    $stars = $_POST['stars'];
                    $durasi = $_POST['durasi'];

                  
                    if ($_FILES["gambar_film"]["error"] == UPLOAD_ERR_OK) {
                        $target_dir = "assets/";
                        $target_file = $target_dir . basename($_FILES["gambar_film"]["name"]);
                        

                        move_uploaded_file($_FILES["gambar_film"]["tmp_name"], $target_file);

                        
                        $gambar_film = $target_file;
                        $update_query = "UPDATE film SET nama_film='$nama_film', gambar_film='$gambar_film', deskripsi_film='$deskripsi_film', tahun='$tahun' WHERE id_film='$id_film'";
                    } else {
                        $update_query = "UPDATE film SET nama_film='$nama_film', deskripsi_film='$deskripsi_film', tahun='$tahun' WHERE id_film='$id_film'";
                    }

                    
                    $result_update = mysqli_query($conn, $update_query);

                    if ($result_update) {
                        echo '<script>if(!alert("List berhasil di update")) document.location = "movielist.php";
                            </script>';
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    $sql = "SELECT * FROM film WHERE id_film = '$id_film'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        ?>

                        <!-- Form untuk mengedit film -->
                        <div class="center">
<table>
    <tr>
        <td>
            <div class="mywatch">
                <h1>Edit Film</h1>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="shape"></div>
        </td>
    </tr>
    </table>
</div>
<div class="tengah">
    <div class="table">
    <table>
    <form method="POST" action="tambahfilm.php" enctype="multipart/form-data">
        <tr>
            <td><label for="id_film">ID Film</label></td>
            <td colspan="2"><input type="number" id="id_film" name="id_film" value="<?php echo $row['id_film']; ?>" readonly></td>
        </tr>
        <tr>
            <td><label for="nama_film">Title</label></td>
            <td colspan="2"><input type="text" id="nama_film" name="nama_film" value="<?php echo $row['nama_film']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="tahun">Year</label></td>
            <td colspan="2"><input type="number" id="tahun" name="tahun" value="<?php echo $row['tahun']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="durasi">Duration</label></td>
            <td colspan="3"><input type="text" id="durasi" name="durasi" value="<?php echo $row['durasi']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="direktor">Directors</label></td>
            <td colspan="2"><input type="text" id="direktor" name="direktor" value="<?php echo $row['direktor']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="writer">Writers</label></td>
            <td colspan="2"><input type="text" id="writer" name="writer" value="<?php echo $row['writer']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="stars">Stars</label></td>
            <td colspan="2"><input type="text" id="stars" name="stars" value="<?php echo $row['stars']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="gambar_film">Poster picture</label></td>
            <td colspan="2"><input type="file" name="gambar_film" id="gambar_film" accept="image/*" class="file" required>
            <img src="<?php echo $row['gambar_film']; ?>" alt="Current Image" width="100"><br><label for="gambar_film" class="upload">Upload Image</label></td>
        </tr>
        <tr>
            <td><label for="deskripsi_film">Film Description</label></td>
            <td class="kecil"><textarea id="deskripsi_film" name="deskripsi_film" required><?php echo $row['deskripsi_film']; ?></textarea></td>
            <td><button type="submit">Submit</button><br><button onclick="cancel()">Cancel</button></td>
            <script>
                function cancel() {
                window.history.back();
                }
            </script>
        </tr>
        <tr>
            <td><td>
        </tr>
        </form>
    </table>
</form>
</div>
</div>
                        <?php
                    } else {
                        echo 'Data tidak ditemukan.';
                    }
                }
            }
        } else {
            echo "Anda tidak memiliki izin untuk mengedit film.";
        }
    }
}
?>
