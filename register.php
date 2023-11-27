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
<title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/regis.css">

</head>
<body>
    <h1>REGISTER</h1>
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
        <?php echo $notification; ?>
    </div>
</body>
</html>