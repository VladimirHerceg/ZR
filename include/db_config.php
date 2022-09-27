<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "zavrsniRad";

$connection = mysqli_connect("$host", "$username", "$password") or die(mysqli_error($connection));
mysqli_select_db($connection,"$db") or die(mysqli_error($connection));
mysqli_query($connection,"SET NAMES utf8") or die (mysqli_error($connection));
mysqli_query($connection,"SET CHARACTER SET utf8") or die (mysqli_error($connection));
mysqli_query($connection,"SET COLLATION_CONNECTION='utf8_general_ci'") or die (mysqli_error($connection));

?>