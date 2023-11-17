<?php

require("koneksi.php");
session_start();


if(isset($_SESSION['username'])) {
    header("location: homepage.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("location: homepage.php");
    } else {
        echo "Login failed. Please check your username and password.";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
    <h2>Login</h2>
    <table>
    <form method="post" action="">
        <tr>
            <td><label for="username">Username</label></td>
            <td>:</td>
            <td> <input type="text" name="username" required></td></tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td>:</td>
            <td><input type="password" name="password" required></td></tr>
        <tr>
            <td> <input type="submit" value="Login"></td></tr>
        </form>
        </table>
        <p>belum memiliki akun?</p>
            <a href="register.php">Registerasi</a>
    </body>
</html>
