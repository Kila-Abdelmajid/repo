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
    <title>Principale</title>
    <style>
   body {
    background-color: #121212; 
    font-family: Arial, sans-serif;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    text-align: center;
}

h1 {
    color: #ffffff;
    font-size: 3em; 
    margin-bottom: 30px;
}

.menu {
    display: flex;
    flex-direction: column; 
    align-items: center; 
}

button {
    width: 200px; 
    margin: 10px 0;
    padding: 15px;
    border: none;
    border-radius: 5px;
    background-color: #333333;
    color: #ffffff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

button:hover {
    background-color: #444444;
    transform: translateY(-2px);
}

button:active {
    transform: translateY(1px);
}

button a {
    text-decoration: none;
    color: inherit;
}

</style>
</head>
<body>
    <div class="sidebar">
        <h1>Page Principale</h1>
        
            
            <button><a href="partiemission.php">Add Missions</a></button>  
            <button><a href="partieaffichemission.php">Affiche Mission</a></button>
            <button><a href="missionshared.php">Mission shared with you</a></button>
            <button><a href="logout.php">Log Out</a></button>
           
        
       
    </div>
</body>
</html>
