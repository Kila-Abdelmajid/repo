<?php
session_start();
include('include.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
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

.login {
    background-color: #202020;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.7), -5px -5px 15px rgba(100, 100, 100, 0.2);
    width: 350px;
    animation: fadeIn 1s ease-in-out;
    text-align: center;
}

.login h1 {
    color: #f0f0f0;
    font-size: 2rem;
    margin-bottom: 30px;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}

.login label {
    color: #bfbfbf;
    display: block;
    margin-bottom: 10px;
    text-align: left;
}

.login input {
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

.login input:focus {
    background-color: #383838;
    outline: none;
    box-shadow: inset 2px 2px 10px rgba(255, 0, 150, 0.5), inset -2px -2px 10px rgba(100, 100, 100, 0.1);
}

.login button {
    width: 100%;
    padding: 12px;
    background-color: #262626;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7), -2px -2px 10px rgba(100, 100, 100, 0.2);
}

.login button:hover {
    background-color: #343434;
    transform: translateY(-3px);
    box-shadow: 4px 4px 20px rgba(255, 0, 150, 0.5), -4px -4px 20px rgba(100, 100, 100, 0.2);
}

.login .link {
    margin-top: 20px;
    color: #bfbfbf;
}

.login .link a {
    color: #ff0096;
    text-decoration: none;
    transition: color 0.3s ease;
}

.login .link a:hover {
    color: #ff33aa;
}
.message{
    color:white;
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
<div class="login">
       <?php
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $etat = "active";
        $droit = "admin";


        $stmt = $conn->prepare("SELECT id,email, mot_de_passe, etat, droit FROM users WHERE email = ? AND etat = ?");
        $stmt->bind_param("ss", $email, $etat);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
           
            if (password_verify($password, $user['mot_de_passe'])) {
                $_SESSION['user_id'] = $user['id'];
               
                @$_SESSION['email']=$email;
                if ($user['droit'] === 'admin') {
                    header("Location: adminpage.php");
                  
                   
                } else {
                    header("Location: partieprincipale.php");
                    
                    
                }
                exit();
            } else {
                echo "<div class='message'><p>Wrong username or password, or your account is not active</p></div><br>";
                echo "<a href='partielogin.php'><button class='btn'>Go Back</button></a>";
            }
        } else {
            echo "<div class='message'><p>Wrong username, password, or your account is not active</p></div><br>";
            echo "<a href='partielogin.php'><button class='btn'>Go Back</button></a>";
        }
        $stmt->close();
    } else {
    ?>
    <form action="partielogin.php" method="POST">
        <h1>Log In</h1>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        

        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="submit" name="login">Log In</button>
        <div class="link">
            Don't have account? <a href="partiesignup.php">Sign Up</a> 
        </div>
    </form>
    <?php }  ?>
</div>
</body>
</html>