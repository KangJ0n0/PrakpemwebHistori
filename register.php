<?php
require('koneksi.php');


$notification = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $role = 'user';

    $checkQuery = "SELECT username FROM user WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        
        $notification = "Username sudah digunakan, silahkan buat username lain.";
    } else {
        
        $query = "INSERT INTO user (email, username, password, role) VALUES ('$email', '$username', '$password', '$role')";
        $result = mysqli_query($conn, $query);

       
        if ($result) {
            
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
