<?php 
session_start();
include('include.php');
if(!isset($_SESSION['email'])){
    header("location:partielogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body {
    background-color: #141414;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.mission {
    background-color: #202020;
    border-radius: 15px;
    padding: 40px;
    width: 350px;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.7), -5px -5px 15px rgba(100, 100, 100, 0.2);
    position: relative;
    overflow: hidden;
    animation: fadeIn 1s ease-in-out;
}
.mission::before {
    content: '';
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255, 0, 150, 0.5), transparent);
    border-radius: 50%;
    animation: rotate 6s linear infinite;
}
.mission h1 {
    color: #f0f0f0;
    text-align: center;
    margin-bottom: 30px;
    font-size: 2rem;
    letter-spacing: 2px;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}
.mission label {
    color: #bfbfbf;
    margin-bottom: 10px;
    display: block;
    font-size: 1rem;
}
.mission input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: none;
    border-radius: 8px;
    background-color: #303030;
    color: #fff;
    font-size: 1rem;
    box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.5), inset -2px -2px 5px rgba(100, 100, 100, 0.1);
    transition: all 0.3s ease;
}
.mission input:focus {
    background-color: #383838;
    outline: none;
    box-shadow: inset 2px 2px 10px rgba(255, 0, 150, 0.5), inset -2px -2px 10px rgba(100, 100, 100, 0.1);
}
.sendmission button {
    width: 100%;
    padding: 12px;
    background-color: #262626;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 1.1rem;
    cursor: pointer;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7), -2px -2px 10px rgba(100, 100, 100, 0.2);
    transition: all 0.3s ease;
}
.sendmission button:hover {
    background-color: #343434;
    transform: translateY(-5px);
    box-shadow: 4px 4px 20px rgba(255, 0, 150, 0.5), -4px -4px 20px rgba(100, 100, 100, 0.2);
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: scale(0.8);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}
.sendmission a{
    text-decoration:none;
    color:white;
}
    </style>
</head>
<body>
    <?php
    
    if(isset($_POST['sendmission']) ){

         @$name=$_POST['name'];
         @$description=$_POST['description'];
         @$user_id = $_SESSION['user_id'];
        //ghadi ykhessni nzid user_id
        $query=mysqli_query($conn,"INSERT INTO missions(nom,description,user_id) VALUES('$name','$description','$user_id')");
       
        if($query){
            echo "<script> alert('insertion de donne est success');</script>";
        }
        else{
            echo "<script> alert('insertion de donne est non success". mysqli_error($conn) ."');</script>";
        }
    }
    
    ?>
    <div class="mission">
        <h1>MISSION</h1>
        <form action="partiemission.php" method="post">
            <div class="name">
                <label for="name">Mission Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="name">
                <label for="description">Mission Description</label>
                <input type="text" id="description" name="description" required>
            </div>
            <div class="sendmission">
                <button type="submit" name="sendmission">Add Mission</button>
                <button ><a href="partieprincipale.php">retourner</a></button>
            </div>
        </form>

    </div>
    
</body>
</html>