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
    <link rel="stylesheet" type="text/css" href="css/regis.css">

<body>
<div class="container"> 
            <div class="right">
    <table>
        <tr>
            <td colspan="2" align="center"><h2>Create an Account</h2></td>
        </tr>
        <form method="post" action="">
        <div class="login">
        <tr>
            <td colspan="2">
            <div class="username">
                <div class="kotak1"><img src="../assets/mail1.png"></div>
                <div class="kotak2"><input type="text" name="email" required></div>
            </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <div class="username">
                <div class="kotak1"><img src="../assets/user2.png"></div>
                <div class="kotak2"><input type="text" name="username" required></div>
            </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <div class="username">
                <div class="kotak1"><img src="../assets/lock2.png"></div>
                <div class="kotak2"><input type="password" name="password" required></div>
            </div>
            </td>
        </tr>
            <td colspan="2"><div class="login"><input type="submit" value="Register"></div></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><a href="index.php">Already have an account?</a></td>
        </tr>
        </form>
</div>
            </table>
        </div>
        <div class="kanan"><img src="../assets/image 23.png"></div>
</div> 
</body>
</html>
