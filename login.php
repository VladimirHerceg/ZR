<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE); 
include "include/db_config.php";
define("SALT1", "gas412p4o12i4h1e24j12e4b124sp22rg14fdgs132125df2g");
define("SALT2", "r2g3h5l6r7t8s6d7u35g24y4123432dkow62ig236622ute2ywoihutyp");


    $username=mysqli_real_escape_string($connection,$_POST['username']);
    $pass= md5(SALT1.mysqli_real_escape_string($connection,$_POST['password']).SALT2);
    $code = $_POST['code'];


    if (empty($username) || empty($pass) || empty($code)) {
        header("Location:login1.php?r=0");
        echo "empty<br>";
        exit();
    } else {
        $sql = "SELECT * FROM members WHERE username='$username'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location:login1.php?r=3");
            echo "user<br>";
            exit();
        }
        elseif ($row['Banned'] == '1') {
            header("Location:login1.php?r=7");
            exit();
}
        elseif (($code != $_SESSION["code"]) || !isset($_SESSION["code"]) || empty($_SESSION["code"]))  {

                unset($_SESSION["code"]);
                unset($code);
            header("Location:login1.php?r=5");
            echo"code<br>";
            exit;
        }
        elseif ($pass != $row['Password'])  {

                        header("Location:login1.php?r=4");
                        exit();
                    }
                    elseif ($row['EmailConfirm'] == '0') {
            
                    
                        $header = "From:<hercegznadlanu@gmail.com>\n";
                        $header .= "X-Mailer: PHP\n";
                        $header .= "Return-Path: <hercegznadlanu@gmail.com>\n";
                        $header .= "Content-Type: text/html; charset=UTF-8\n";
                        $to = $row['Email']; 
                        $subject = "AniForum verification mail";
                        $message = "<a href='https://zavrsniradvladimir.000webhostapp.com/verifyMail.php?token=".$row['Token']."'>Click this to verify E-Mail</a>";
    
                        if (mail($to, $subject, $message, $header))
                            header("Location:login1.php?r=1");
                            exit();
            
        }
        else {
                        //logovanje usera
                        $_SESSION['u_id'] = $row['Id'];
                        $_SESSION['u_username'] = $row['Username'];
                        $_SESSION['u_email'] = $row['Email'];
                        $_SESSION['u_phone'] = $row['Phone'];
                        $_SESSION['u_moderator'] = $row['Moderator'];
                        $_SESSION['u_admin'] = $row['Admin'];
                        $_SESSION['u_banned'] = $row['Banned'];
                        header("Location:index.php");
                        exit();
                    }
            }
                
//ovo ne dozvoljavamo da direktno preko url udju na signup.php

?>