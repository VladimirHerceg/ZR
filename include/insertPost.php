<?php
require 'db_config.php';
session_start();
if (!isset($_SESSION['u_id'])) {
  header("Location:../index.php");
}
else {
$id = $_SESSION['u_id'];
}
$sql = "SELECT * FROM members WHERE Id = $id";

$result=mysqli_query($connection,$sql);
if(mysqli_num_rows($result)>0){
  while ($record= mysqli_fetch_array($result)){
    $PT=$record["PTotal"]+1;
    $PC=$record["PCurrent"]+1;
  }
}
$title="";
if(isset($_POST["title"]))
$title=$_POST["title"];

$content="";
if(isset($_POST["content"]))
$content=$_POST["content"];

$image="";
if(isset($_POST["image"]))
$image=$_POST["image"];
$image2="alt";

    date_default_timezone_set('Europe/Belgrade');
$vreme = getDate();
$datum = $vreme["year"]."-".$vreme["mon"]."-".$vreme["mday"]." ".$vreme["hours"].":".$vreme["minutes"].":".$vreme["seconds"];

if(empty($_FILES["file"]["tmp_name"]))
    {
        $sql="INSERT INTO posts (image, MemberId, Title, Content, Date) VALUES ('$image2','$id','$title',' $content','$datum');";
 $sqlPT="UPDATE members SET PTotal = '$PT' WHERE members.Id = $id;";
 $sqlPC="UPDATE members SET PCurrent = '$PC' WHERE members.Id = $id;";
 $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
 $resultPT=mysqli_query($connection,$sqlPT) or die(mysqli_error($connection));
 $resultPC=mysqli_query($connection,$sqlPC) or die(mysqli_error($connection));

        header("Location:../newPost.php?i=0");
        exit();

    }

    if ($_FILES['file']["error"] > 0) {
        echo "Something went wrong during file upload!";
    } else {
        if (isset($_FILES["file"]) AND is_uploaded_file($_FILES['file']['tmp_name'])) {

            $fileName = $_FILES['file']["name"];
            $fileTemp = $_FILES["file"]["tmp_name"];
            $fileSize = $_FILES["file"]["size"];
            $fileType = $_FILES["file"]["type"];
            $fileError = $_FILES['file']["error"];


            $directory = "../images/posts/posts(resized)";
            $nameOfFile=$fileName;
            $fileName = time().".jpg";
            $upload = "$directory/$fileName";


            if (!is_dir($directory))
                mkdir($directory);

            if (!file_exists($upload)) {
                if (move_uploaded_file($fileTemp, $upload)) {
                    $sql="INSERT INTO posts (image, MemberId, Title, Content, Date) VALUES ('$fileName','$id','$title',' $content','$datum');";
                    $sqlPT="UPDATE members SET PTotal = '$PT' WHERE members.Id = $id;";
                    $sqlPC="UPDATE members SET PCurrent = '$PC' WHERE members.Id = $id;";
                    $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                    $resultPT=mysqli_query($connection,$sqlPT) or die(mysqli_error($connection));
                    $resultPC=mysqli_query($connection,$sqlPC) or die(mysqli_error($connection));
                    header("Location:../newPost.php?i=0");
                    exit();

                } else
                    echo "Ne postoji folder";
                    echo "<p><b>$upload</b></p>";
                    echo "<p><b>$directory</b></p>";
            } else
                echo "<p><b>File with this name already exists!</b></p>";
        }

    }
?>