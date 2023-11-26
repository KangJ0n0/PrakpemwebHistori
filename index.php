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
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Calistoga&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="left"><img src="../assets/image 22.png"></div>
            
            <div class="right">
            <table>
                <tr>
                <td colspan="2" align="center"><h6>LOGIN</h6></td>
                </tr>
    <form method="post" action="">
        <div class="login">
        <tr>
            <td colspan="2">
            <div class="username">
                <div class="kotak1"><img src="../assets/user1.png"></div>
                <div class="kotak2"><input type="text" name="username"></div>
            </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <div class="username">
                <div class="kotak1"><img src="../assets/lock1.png"></div>
                <div class="kotak2"><input type="text" name="password"></div>
            </div>
            </td>
        </tr>
            <td colspan="2"><div class="login"><input type="submit" value="login"></div></td>
        </tr>
        </form>
        <tr>
</div>
        <td><input type="checkbox"> remember me</td>
        <td align="right"><a href="">fotgot password?</a></td>
        </tr>
        <td> </td>
        <td align="right"><a href="">Don't have account?</a></td>
        </tr>
            </table>
        </div>
</div>  
    </body>
</html>
