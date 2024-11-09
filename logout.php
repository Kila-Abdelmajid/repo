<?php
session_start();
session_unset();
header("location:partielogin.php");
session_destroy();

?>