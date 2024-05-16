<?php
$servername="localhost";
$username="root";
$password="";
$dbname="basebase";

$conn = new mysqli($servername, $username, $password,$dbname);

if($conn->connect_error){
    die("not connected:".$conn->connect_error);
    
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$dateAbsence=$_POST["dateAbsence"];

$sql="INSERT INTO base_data (nom, prenom, dateAbsence) VALUES('$nom','$prenom','$dateAbsence') ";

if($conn->query($sql)===TRUE){
    echo"gooood";
}
else{
    echo"not goood".$conn->error;
}
}
$conn->close();
?>