
<?php
session_start();
include('include.php');


if (!isset($_SESSION['email'])) {
    header("location:partielogin.php");
    exit;
}

$user_id = $_SESSION['user_id'];


if (isset($_POST['share_mission'])) {
    $mission_id = $_POST['mission_id'];
    $shared_username = $_POST['shared_username'];


    $user_query = mysqli_query($conn, "SELECT id FROM users WHERE nom = '$shared_username'");
    
    if (mysqli_num_rows($user_query) > 0) {
        $user_row = mysqli_fetch_assoc($user_query);
        $shared_user_id = $user_row['id'];
        
        $check_share_query = "SELECT * FROM shared_mission WHERE mission_id = '$mission_id' AND user_partage_id = '$shared_user_id'";
        $check_result = mysqli_query($conn, $check_share_query);

        if (mysqli_num_rows($check_result) == 0) {

            $share_mission_query = "INSERT INTO shared_mission (mission_id, user_partage_id) VALUES ('$mission_id', '$shared_user_id')";
            mysqli_query($conn, $share_mission_query);


            $tasks_query = mysqli_query($conn, "SELECT id FROM tasks WHERE mission_id = '$mission_id'");
            while ($task_row = mysqli_fetch_assoc($tasks_query)) {
                $task_id = $task_row['id'];

                $check_task_share_query = "SELECT * FROM shared_tasks WHERE task_id = '$task_id' AND user_partage_id = '$shared_user_id'";
                $check_task_result = mysqli_query($conn, $check_task_share_query);

                if (mysqli_num_rows($check_task_result) == 0) {
                    $share_task_query = "INSERT INTO shared_tasks (task_id, user_partage_id) VALUES ('$task_id', '$shared_user_id')";
                    mysqli_query($conn, $share_task_query);
                }
            }
            
            echo "<p>Mission and its tasks shared successfully with $shared_username!</p>";
        } else {
            echo "<p>This mission is already shared with $shared_username!</p>";
        }
    } else {
        echo "<p>User not found!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiche Mission</title>
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
<h1>AFFICHE LES MISSIONS</h1>
    <button><a href="partieprincipale.php">Retourner</a></button>

    <?php

    $query = mysqli_query($conn, "SELECT m.id, m.nom, m.description, m.user_id FROM missions m WHERE m.user_id = '$user_id'");
    
    while ($row = mysqli_fetch_assoc($query)) {
        $_SESSION['mission_id'] = $row['id'];
    ?>
        <div class="affichemission">
            <p>Id Mission: <?php echo $row['id']; ?></p>
            <p>Nom de Mission: <?php echo $row['nom']; ?></p>
            <p>Description: <?php echo $row['description']; ?></p>
            <p>Created by User ID: <?php echo $row['user_id']; ?></p>
            <p><a href="affichetasks.php?mission_id=<?php echo $row['id']; ?>"><button>Affiche Tasks</button></a></p>
            <p><a href="partietask.php?mission_id=<?php echo $row['id']; ?>"><button>Add Tasks</button></a></p>
            <p><a href="deletemission.php?id=<?php echo $row['id']; ?>"><button>Delete</button></a></p>
            <p><a href="updatemission.php?mission_id=<?php echo $row['id']; ?>"><button>Update</button></a></p>


            <form method="POST" action="">
                <input type="hidden" name="mission_id" value="<?php echo $row['id']; ?>">
                <label for="shared_username">Share with Username:</label>
                <input type="text" name="shared_username" required>
                <button type="submit" name="share_mission">Share Mission and Tasks</button>
            </form>
        </div>
    <?php } ?>
</body>
</html>