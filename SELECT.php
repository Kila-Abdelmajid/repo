
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de données</title>
    <style>
      
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;

        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<?php
$servername="localhost";
$username="root";
$password="";
$dbname="basebase";

$conn = new mysqli($servername, $username, $password,$dbname);

if($conn->connect_error){
    die("not connected:".$conn->connect_error);
}

$sql="SELECT nom, prenom,dateAbsence FROM base_data ";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>NOM</th><th>PRENOM</th><th>Date Absence</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nom"]. "</td><td>" . $row["prenom"]. "</td><td>" . $row["dateAbsence"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "le tableau est vide ";
}

$conn->close();
?>

</body>
</html>
