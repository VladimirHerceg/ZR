<?php
include ("include/db_config.php");
define("SALT1", "gas412p4o12i4h1e24j12e4b124sp22rg14fdgs132125df2g");
define("SALT2", "r2g3h5l6r7t8s6d7u35g24y4123432dkow62ig236622ute2ywoihutyp");


    $Username= mysqli_real_escape_string($connection,$_POST['Username']);
    $Password= mysqli_real_escape_string($connection,$_POST['Password']);
    $RepeatPass= mysqli_real_escape_string($connection,$_POST['RepeatPass']);
    $Email= mysqli_real_escape_string($connection,$_POST['Email']);
    $Phone= mysqli_real_escape_string($connection,$_POST['Phone']);

    if(empty($Username) || empty($Password) || empty($RepeatPass || empty($Email) || empty($Phone) )){

        header("Location:registration.php?l=0");
        exit();
    }else{
                    $sql="SELECT * from members WHERE username='$Username'";
                    $result=mysqli_query($connection,$sql);
                    $resultCheck=mysqli_num_rows($result); //proveravamo da li imamo rezultat u prethodnoj naredbi

                    if($resultCheck>0){
                        header("Location:registration.php?l=1");
                        exit();
                    }else{
                        $sql="SELECT * from members WHERE email='$Email'";
                        $result=mysqli_query($connection,$sql);
                        $resultCheck=mysqli_num_rows($result); //proveravamo da li imamo rezultat u prethodnoj naredbi

                        if($resultCheck>0) {
                            header("Location:registration.php?l=2");
                            exit();

                        }else{
                            //token za reg
                            $token="qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM0123456789!$/()*";
                            $token=str_shuffle($token);
                            $token=substr($token,0,10);


                            //hashing the password osiguravanje sifre (fora kao MD5)
                            $hashedPass = md5(SALT1.$Password.SALT2);


                            $sql = "INSERT INTO members (username,password,email,phone,token) 
                            VALUES ('$Username','$hashedPass','$Email','$Phone','$token');";
                            $result = mysqli_query($connection, $sql);

                            header("Location:login1.php?r=6");

                            $header = "From:<hercegznadlanu@gmail.com>\n";
                            $header .= "X-Mailer: PHP\n";
                            $header .= "Return-Path: <hercegznadlanu@gmail.com>\n";
                            $header .= "Content-Type: text/html; charset=UTF-8\n";
                            $to = "$Email";
                            $subject = "AniForum verification mail";
                            $message = "<a href='https://zavrsniradvladimir.000webhostapp.com/verifyMail.php?token=$token'>Click this to verify E-Mail</a>";


                            if (mail($to, $subject, $message, $header))
                                echo "Mail was sent!";
                            else
                                echo "Error occurred during sending mail";


                            exit();
                        }
                    }
                }

            

        
    
    //ovo ne dozvoljavamo da direktno preko url udju na signup.php
     ?>