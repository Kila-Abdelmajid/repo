<?php
session_start();
include('include.php');
@$id=$_GET['id'];
if(isset($id)){
$delete=mysqli_query($conn,"DELETE FROM tasks WHERE id=$id");
header("location:affichetasks.php");}
?>