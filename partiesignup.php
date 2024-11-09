<?php
include('include.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
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

.signup {
    background-color: #202020;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.7), -5px -5px 15px rgba(100, 100, 100, 0.2);
    width: 350px;
    animation: fadeIn 1s ease-in-out;
    text-align: center;
}

.signup h1 {
    color: #f0f0f0;
    font-size: 2rem;
    margin-bottom: 30px;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}

.signup label {
    color: #bfbfbf;
    display: block;
    margin-bottom: 10px;
    text-align: left;
}

.signup input {
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

.signup input:focus {
    background-color: #383838;
    outline: none;
    box-shadow: inset 2px 2px 10px rgba(255, 0, 150, 0.5), inset -2px -2px 10px rgba(100, 100, 100, 0.1);
}

.signup button {
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

.signup button:hover {
    background-color: #343434;
    transform: translateY(-3px);
    box-shadow: 4px 4px 20px rgba(255, 0, 150, 0.5), -4px -4px 20px rgba(100, 100, 100, 0.2);
}

.signup p {
    color: #bfbfbf;
    margin-top: 15px;
}

.signup p a {
    color: #ff0096;
    text-decoration: none;
    transition: color 0.3s ease;
}

.signup p a:hover {
    color: #ff33aa;
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
    <div class="signup">
        <?php
        if(isset($_POST['signup'])){
            @$username=$_POST['username'];
            @$email=$_POST['email'];
           @$password=$_POST['password'];

           $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query=mysqli_query($conn,"INSERT INTO users(nom,droit,etat,email,mot_de_passe) VALUES('$username','user','desactive','$email','$hashed_password')");
            if(isset($query)){
                echo"<script>alert('your account is created');</script>";
            }
            else{
                echo"<script>alert('error de connection');</script>";
            }
        }
        ?>
        <form action="partiesignup.php" method="post">
            <h1>SignUp</h1>
            <label for="username">User Name</label>
            <input type="text" name="username" id="username" required >

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
           
             <!--hadi zdtha 3la hssab token-->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <button type="submit" name="signup">Sign Up</button>
            <p>already have an account <a href="partielogin.php">Log In</a></p>
        </form>
    </div>
    
</body>
</html>