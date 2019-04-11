<?php
$servername = 'localhost';
$username = 'root';
$password = '';

// Create connection
$con = new mysqli($servername, $username, $password, "pw5");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
echo "Connected successfully";

$name = mysqli_real_escape_string($con, $_POST['name']);
$username = mysqli_real_escape_string($con, $_POST['username']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$book = mysqli_real_escape_string($con, $_POST['book']);
$avatar = mysqli_real_escape_string($con, $_POST['avatar']);

$userpass = password_hash($_POST['password'], PASSWORD_BCRYPT);

$sql="INSERT INTO users (username, password, fullname, email, avatar) VALUES "
        . "('$username', '$userpass', '$name', '$email', '$avatar')";
if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }
echo "1 record added";
$sql="INSERT INTO favoritebooks (username, booktitle) VALUES "
        . "('$username', '$book')";
if (!mysqli_query($con,$sql))
        {
        die('Error: ' . mysqli_error($con));
        }
echo "1 record added";
?>

