<?php
session_start();
include('include.php');
if (!isset($_SESSION['email'])) {
    header("location:partielogin.php");
    exit;
}

$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shared Missions and Tasks</title>
    <style>
    body {
        background-color: #121212;
        color: #e0e0e0;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h1, h2, h3 {
        color: #bb86fc;
        text-align: center;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
    }

    a {
        color: #bb86fc;
        text-decoration: none;
    }

    button {
        margin-top: 10px;
        background-color: #3700b3;
        color: #e0e0e0;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    button:hover {
        transform: translateY(-2px);
        box-shadow: 2px 5px 15px rgba(0, 0, 0, 0.7);
    }

    .shared-mission {
        background-color: #1e1e1e;
        border-radius: 8px;
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.8);
        padding: 20px;
        margin: 20px;
        width: 80%;
        max-width: 600px;
        text-align: left;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background: linear-gradient(145deg, #292929, #1e1e1e);
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.8);
    }


    li:hover {
        background: #333;
        transform: translateY(-2px);
        box-shadow: 3px 5px 12px rgba(0, 0, 0, 0.7);
    }

    hr {
        border: 1px solid #444;
        width: 90%;
        margin: 1.5rem auto;
    }
</style>
</head>
<body>
    <h1>MISSIONS AND TASKS SHARED WITH YOU</h1>
    <button><a href="partieprincipale.php">Return to Main Page</a></button>

    <?php

    $mission_query = mysqli_query($conn, "
        SELECT m.id AS mission_id, m.nom AS mission_name, m.description AS mission_description, m.user_id AS mission_creator
        FROM missions m
        JOIN shared_mission ms ON m.id = ms.mission_id
        WHERE ms.user_partage_id= '$user_id'
    ");


    if (mysqli_num_rows($mission_query) > 0) {
        while ($mission_row = mysqli_fetch_assoc($mission_query)) {
            $mission_id = $mission_row['mission_id'];
            ?>
            <div class="shared-mission">
                <h2>Mission: <?php echo $mission_row['mission_name']; ?></h2>
                <p>Description: <?php echo $mission_row['mission_description']; ?></p>
                <p>Created by User ID: <?php echo $mission_row['mission_creator']; ?></p>


                <h3>Tasks:</h3>
                <ul>
                    <?php
                    $task_query = mysqli_query($conn, "
                        SELECT t.id AS task_id, t.nom AS task_name, t.description AS task_description
                        FROM tasks t
                        JOIN shared_tasks ts ON t.id = ts.task_id
                        WHERE ts.user_partage_id = '$user_id' AND t.mission_id = '$mission_id'
                    ");
                    
                    if (mysqli_num_rows($task_query) > 0) {
                        while ($task_row = mysqli_fetch_assoc($task_query)) {
                            ?>
                            <li>
                                <strong>Task Name:</strong> <?php echo $task_row['task_name']; ?><br>
                                <strong>Description:</strong> <?php echo $task_row['task_description']; ?>
                            </li>
                            <?php
                        }
                    } else {
                        echo "<p>No tasks shared for this mission.</p>";
                    }
                    ?>
                </ul>
            </div>
            <hr>
            <?php
        }
    } else {
        echo "<p>No missions have been shared with you.</p>";
    }
    ?>
</body>
</html>
