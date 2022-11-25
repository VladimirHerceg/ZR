<?php
include "include/db_config.php";

if(!isset($_GET["token"])){ //ne mogu uci direktno
    header('Location:login1.php?');
    exit();
}else{
    $token = $_GET["token"];
    $sql= "SELECT id FROM members WHERE Token='$token' AND EmailConfirm='0'";
    $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
    $resultCheck=mysqli_num_rows($result);
    //mysqli_error($connection);
    if($resultCheck>0){
        $sql="UPDATE members SET EmailConfirm='1', Token='' WHERE Token='$token'";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header('Location:login1.php?r=2');
        exit();
    }else{
        header('Location:login1.php?');
        exit();
    }
}
?>