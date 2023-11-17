<?php
require('koneksi.php');

// Inisialisasi pesan notifikasi
$notification = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Role value (assuming 'user' is one of the ENUM values)
    $role = 'user';

    // Check if the username already exists in the database
    $checkQuery = "SELECT username FROM user WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Username already exists, display an error message
        $notification = "Username sudah digunakan, silahkan buat username lain.";
    } else {
        // Insert the new user into the database with the 'user' role
        $query = "INSERT INTO user (email, username, password, role) VALUES ('$email', '$username', '$password', '$role')";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            // Set success notification
            $notification = "Pendaftaran berhasil!";
        } else {
            $notification = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registerasi</title>
</head>
<body>
    <h1>REGISTERASI</h1>
    <table>
    <form method="POST" action="">
            <tr>
                <td><label>Email</label></td>
                <td>:</td>
                <td><input type="text" name="email" required></td></tr>
            <tr>
                <td><label>Username</label></td>
                <td>:</td>
                <td><input type="text" name="username" required></td></tr>
            <tr>
                <td><label>Password</label></td>
                <td>:</td>
                <td><input type="password" name="password" required></td></tr>
            <tr>
                <td><input type="submit" value="Register"></td><tr> 
        </form>  
        </table>
        <a href="index.php">Login</a> 
        <?php echo $notification; ?> <!-- Menampilkan notifikasi -->
    </div>
</body>
</html>