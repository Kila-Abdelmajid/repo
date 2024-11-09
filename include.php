<?php
$host='localhost';
$password='';
$user='root';
$dbname='webtp0';
$conn=mysqli_connect($host,$user,$password,$dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>