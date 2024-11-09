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
    <title>Task</title>
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

.task {
    background-color: #202020;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.7), -5px -5px 15px rgba(100, 100, 100, 0.2);
    width: 400px;
    text-align: center;
    animation: fadeIn 1s ease-in-out;
}

.task h1 {
    color: #f0f0f0;
    font-size: 2.2rem;
    margin-bottom: 20px;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}

.task label {
    color: #bfbfbf;
    margin-bottom: 10px;
    display: block;
    text-align: left;
    font-size: 1rem;
}

.task input, .task select {
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

.task input:focus, .task select:focus {
    background-color: #383838;
    outline: none;
    box-shadow: inset 2px 2px 10px rgba(255, 0, 150, 0.5), inset -2px -2px 10px rgba(100, 100, 100, 0.1);
}

.sendtask button {
    padding: 12px;
    width: 100%;
    background-color: #262626;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7), -2px -2px 10px rgba(100, 100, 100, 0.2);
}

.sendtask button:hover {
    background-color: #343434;
    transform: translateY(-3px);
    box-shadow: 4px 4px 20px rgba(255, 0, 150, 0.5), -4px -4px 20px rgba(100, 100, 100, 0.2);
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

    </style>
</head>
<body>
    <?php
 @$m_id = $_GET['mission_id']; 
    if(isset($_POST['sendtask'])){
        @$user_id = $_SESSION['user_id'];
        @$mission_id = $_SESSION['mission_id'];
         @$name=$_POST['name'];
        @$description=$_POST['description'];
         @$priorite=$_POST['priorite'];
         @$resultat=$_POST['resultat'];
        //ghadi ykhessni nzid user_id mission_id

        $query=mysqli_query($conn,"INSERT INTO tasks(nom,description,resultat,priorite,user_id,mission_id) VALUES('$name','$description','$resultat','$priorite','$user_id','$mission_id')");

        if($query){
            echo "<script> alert('insertion de donne est success');</script>";
        }
        else{
            echo "<script> alert('insertion de donne est non success');</script>";
        }
    }

        ?>
    <div class="task">
        <h1>ADD Task</h1>

        <form action="partietask.php" method="post">
        <input type="hidden" name="mission_id" value="<?php echo $mission_id; ?>"> <!-- Pass the mission ID here -->
            <div class="name">
                <label for="name">Task Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="name">
                <label for="description">Task Description</label>
                <input type="text" id="description" name="description" required>
            </div>
           
            <label for="priorite">Priorite</label>
                <select id="priorite" name="priorite">
                    <option value="Haute">Haute</option>
                    <option value="Moyenne">Moyenne</option>
                    <option value="Basse">Basse</option>
                </select><br>

            <label for="resultat">resultat</label>
                <select id="resultat" name="resultat">
                    <option value="EnCours">EnCours</option>
                    <option value="Terminee">Terminee</option>
                    <option value="Impossible">Impossible</option>
                    <option value="Reporte">Reporte</option>
                </select><br>

                <div class="sendtask">
                    <button type="submit" name="sendtask">Add Task</button>
                    <button ><a href="partieprincipale.php">retourner</a></button>
                </div>

        </form>
      
    </div>
</body>
</html>