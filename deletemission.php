<?php
session_start();
include('include.php');


if (!isset($_SESSION['email'])) {
    header("location:partielogin.php");
    exit;
}


if (isset($_GET['id'])) {
    $mission_id = $_GET['id'];


    $tasks_query = mysqli_query($conn, "SELECT id FROM tasks WHERE mission_id = '$mission_id'");
    while ($task_row = mysqli_fetch_assoc($tasks_query)) {
        $task_id = $task_row['id'];

        mysqli_query($conn, "DELETE FROM shared_tasks WHERE task_id = '$task_id'");
    }


    mysqli_query($conn, "DELETE FROM tasks WHERE mission_id = '$mission_id'");


    mysqli_query($conn, "DELETE FROM missions WHERE id = '$mission_id'");


    header("location:partieaffichemission.php");
    exit;
} else {
    echo "<p>No mission ID specified for deletion!</p>";
    exit;
}
?>
