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
    <title>affiche Tasks</title>
    <style>
     body {
            background-color: #1b1b1b;
            color: #e0e0e0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }


        h1 {
            color: #f0f0f0;
            font-size: 2em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            margin-bottom: 20px;
        }


        .affichemission {
            background-color: #292929;
            padding: 20px;
            margin: 10px;
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5), 0 6px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid #444;
            transition: transform 0.2s;
        }


        .affichemission:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.6), 0 10px 25px rgba(0, 0, 0, 0.4);
        }


        .affichemission p {
            margin: 8px 0;
            color: #d0d0d0;
        }

 
        .affichemission button {
            background-color: #ff6b6b;
            color: #f0f0f0;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px #d45454;
            transition: all 0.2s ease;
        }

 
        .affichemission button:hover {
            background-color: #ff4c4c;
            box-shadow: 0 6px #d45454;
            transform: translateY(-2px);
        }

 
        .affichemission button:active {
            transform: translateY(2px);
            box-shadow: 0 2px #d45454;
        }


        .affichemission a {
            text-decoration: none;
        }
    </style>
</head>
<body> 
    <h1>AFFICHE LES TASKS</h1>
    <button ><a href="partieprincipale.php">retourner</a></button>
            <?php

            @$mission_id = $_GET['mission_id'];
            @$user_id = $_SESSION['user_id'];
            //ghadi nzid join pour user id w missionID
            $query=mysqli_query($conn,"SELECT * FROM tasks WHERE mission_id = '$mission_id' AND user_id = '$user_id'");
            while($row=mysqli_fetch_assoc($query)){

            ?>
            <div class="affichemission">
                <p>id task:<?php echo  $row['id'];?></p>
                <p>nom de task:<?php echo  $row['nom'];?></p>
                <p>description :<?php echo  $row['description'];?></p>
                <p>resultat :<?php echo  $row['resultat'];?></p>
                <p>priorite :<?php echo  $row['priorite'];?></p>
                <p>created BY user id :<?php echo  $row['user_id'];?></p>
                <p>appartient a mission id :<?php echo  $row['mission_id'];?></p>
                <p><a href="deletetasks.php?id=<?php echo $row['id'];?>"><button>Delete</button></a></p>
                <p><a href=""><button>Update</button></a></p>

            </div>
            <?php  }?>
    
</body>
</html>