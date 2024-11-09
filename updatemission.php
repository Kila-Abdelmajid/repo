<?php
session_start();
include('include.php');


if (!isset($_SESSION['email'])) {
    header("location:partielogin.php");
    exit;
}

if (isset($_GET['mission_id'])) {
    $mission_id = $_GET['mission_id'];


    $mission_query = mysqli_query($conn, "SELECT * FROM missions WHERE id = '$mission_id'");
    $mission = mysqli_fetch_assoc($mission_query);


    if (!$mission) {
        echo "<p>Mission not found!</p>";
        exit;
    }

 
    if (isset($_POST['update_mission'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];

        
        $update_query = "UPDATE missions SET nom = '$nom', description = '$description' WHERE id = '$mission_id'";
        mysqli_query($conn, $update_query);

        
        header("location:partieaffichemission.php");
        exit;
    }
} else {
    echo "<p>No mission selected for update!</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Mission</title>
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
            margin-bottom: 20px;
        }
        .update-form {
            background-color: #292929;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }
        .update-form input, .update-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #444;
            border-radius: 4px;
            background-color: #1b1b1b;
            color: #e0e0e0;
        }
        .update-form button {
            background-color: #ff6b6b;
            color: #f0f0f0;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .update-form button:hover {
            background-color: #ff4c4c;
        }
    </style>
</head>
<body>
<h1>Update Mission</h1>

<div class="update-form">
    <form method="POST" action="">
        <label for="nom">Mission Name:</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($mission['nom']); ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($mission['description']); ?></textarea>

        <button type="submit" name="update_mission">Update Mission</button>
    </form>
</div>

</body>
</html>
