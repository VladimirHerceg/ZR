<?php
include "db_config.php";
include "searchForm.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ani Forum</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <link href="css/style.css" rel="stylesheet">
</head>
<?php

        echo "<body style='background-color: #333; color: whitesmoke'>";

    
?>
<nav class="navbar container-fluid navbar-expand-lg navbar-light bg-light text-center">
    <div class="AniForum" style="color: #000;"><p>Ani Forum</p></div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Početna </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="posts.php">Postovi </a>
            </li>

            <?php
            if (isset($_SESSION['u_id'])) {
                echo '<li class="nav-item">
                    <a class="nav-link" href="newPost.php">Novo</a>
                 </li>';}
            ?>
            <?php
            if (isset($_SESSION['u_id'])) {
                echo '<li class="nav-item">
                    <a class="nav-link" href="favorite.php?action=see">Omiljeno </a>
                 </li>';}
            ?>
            <?php
            if (isset($_SESSION['u_moderator'])) {
                if($_SESSION['u_moderator']==1){
                    echo '<li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Moderacija
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="moderator.php?action=post">Postovi</a>
                    <a class="dropdown-item" href="moderator.php?action=user">Korisnici</a> 
                    <a class="dropdown-item" href="moderator.php?action=report">Reportovi</a> 
                    <a class="dropdown-item" href="moderator.php?action=ban">Banovani korisnici</a> 
                </div>
            </li>';}
            }

            ?>
            <?php
            if (isset($_SESSION['u_admin'])) {
                if($_SESSION['u_admin']==1){
                    echo '<li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administracija
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="admin.php?action=user">Korisnici</a>            
                <a class="dropdown-item" href="admin.php?action=mod">Moderatori</a>            
                </div>
            </li>';}
            }

            ?></ul>
        <ul class="navbar-nav ms-auto ">
            <!--        deo kad si logovan-->
            <?php
            if (isset($_SESSION['u_id'])) {
                echo '
                  <p style="color:black; font-size: 20px " class="pt-2"><a style="color:black; text-decoration:none;"href="profile.php?action='.$_SESSION['u_id'].'">'.$_SESSION['u_username'].'</a> </p> &nbsp&nbsp
                  <form action="include/logout.php"  method="post">
                    <button type="submit" class="btn btn-sm btn-info" style="margin-top: 7px" name="logout">Izloguj se</button>
                  </form>';
            }else{
                echo '
                <form method="post" action="registration.php">
                <input type="image" src="images/other/person-booth-solid.png" style="height: 45px; width: 55px" alt="Registracija">
                </form> &nbsp&nbsp
                <form action="login1.php" method="post">
                <input type="image" src="images/other/canvas.png" style="height: 45px; width: 55px" alt="Login" >
                </form>';
            }
            ?>  </ul>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>
        <script src="js/javascript.js"></script>
