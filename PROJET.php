
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTION d'ABSENCE</title>
    
    <style>
 body {
    font-family:verdana;
    background-color: #f4f4f4;
    font-weight:bolder;
}
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px black;
    border-radius:20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 20px;
    margin-bottom: 40px;
}

label {
    font-weight: bolder;
    font-size: large;
}

input, button {
    padding: 10px;
    border: 1px solid grey;
    border-radius: 20px;
    transition:0.3s;
    cursor: pointer;
}

button {
    background-color: green;
    color: white;  
}
button:hover,input:hover{
transform: scale(1.1);
 color:black;        
}

a {
  text-decoration: none;
  color: #333;
  background-color: #f0f0f0;
  padding: 10px 20px;
  border: 1px solid grey;
  border-radius: 5px; 
  display: inline-block;
  position:relative;
  left:60%;
  transition:0.6s;
}


a:hover {
  background-color: #ddd;
  transform:scale(1.1); 
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Employe d'Absence </h1>
        <form  method="post" action="INSERT.php">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="date">Date d'Absence</label>
            <input type="date" id="date" name="dateAbsence" required>

            <button type="submit" id="btn" name="btn">Enregistrer</button>
        </form>

    </div>
    <a href="SELECT.php">TABLEAU DES ABSENCES</a>
</body>
</html>



