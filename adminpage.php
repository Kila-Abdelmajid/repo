<?php
session_start();
include('include.php');
if(!isset($_SESSION['email'])){
    header("location:partielogin.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Controle</title>
    <style>
  
    body {
        background-color: #1c1c1c;
        color: #e0e0e0;
        font-family: Arial, sans-serif;
        margin: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
    }


    h1 {
        color: #f0f0f0;
        font-size: 3.5rem;
        margin-top: 40px;
        text-align: center;
        text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.7);
    }


    .button-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-grow: 1;
    }

    .button-container a {
        color: #ffffff;
        background-color: #333333;
        padding: 15px 40px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 1.2rem;
        margin: 10px 0;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.6), -5px -5px 15px rgba(50, 50, 50, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }


    .button-container a:hover {
        transform: translateY(-10px);
        box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.8), -8px -8px 20px rgba(50, 50, 50, 0.3);
        background-color: #222222;
    }
</style>

</head>

<body>
    <h1>ADMIN CONTROLE</h1>
    <div class="button-container">
        <a href="adminusersacount.php">Users Account</a>
        <a href="missionshared.php">missionshared</a>
        <a href="logout.php">LogOut</a>
        
    </div>
</body>
</html>