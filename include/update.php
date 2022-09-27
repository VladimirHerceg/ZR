<?php
include "db_config.php";
session_start();
$userId="";
if(isset($_GET["id2"]))
$userId=$_GET["id2"];
$action="";
if(isset($_GET["action"]))
    $action=$_GET["action"];
$id="";
if(isset($_GET["id"]))
    $id=$_GET["id"];
    $directory = "../images/posts/posts(resized)/";
    switch ($action){
    case "post":
        $sql ="SELECT *, posts.Id as postId FROM posts INNER JOIN members ON members.Id=posts.MemberId WHERE posts.Id=$id;";
        $result=mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0){
  while ($record= mysqli_fetch_array($result)){
    $PD=$record["PDeleted"]+1;
    $PC=$record["PCurrent"]-1;
    $uId=$record["MemberId"];
    $path=$directory.$record["Image"];

  }
}
        $sql = "SELECT * FROM members WHERE Id = $uId";
        $result=mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0){
  while ($record= mysqli_fetch_array($result)){
    $PD=$record["PDeleted"]+1;
    $PC=$record["PCurrent"]-1;
    
    }
}

        unlink($path);
        $sql="DELETE FROM posts WHERE id=$id";
        $sqlPD="UPDATE members SET PDeleted = '$PD' WHERE members.Id = 1;";
        $sqlPC="UPDATE members SET PCurrent = '$PC' WHERE members.Id = 1;";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        $resultPD=mysqli_query($connection,$sqlPD) or die(mysqli_error($connection));
        $resultPC=mysqli_query($connection,$sqlPC) or die(mysqli_error($connection));

        header("Location:../moderator.php?action=post");

    break;
    
    case "deleteMyPost":

        $sql ="SELECT *, posts.Id as postId FROM posts INNER JOIN members ON members.Id=posts.MemberId WHERE posts.Id=$id;";
        $result=mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0){
  while ($record= mysqli_fetch_array($result)){
    $PD=$record["PDeleted"]+1;
    $PC=$record["PCurrent"]-1;
    $uId=$record["MemberId"];
    $path=$directory.$record["Image"];

    
  }
}
        $sql = "SELECT * FROM members WHERE Id = $uId";
        $result=mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0){
  while ($record= mysqli_fetch_array($result)){
    $PD=$record["PDeleted"]+1;
    $PC=$record["PCurrent"]-1;
    
  }
}
        unlink($path);
        $sql="DELETE FROM posts WHERE id=$id";
        $sqlPD="UPDATE members SET PDeleted = '$PD' WHERE members.Id = 1;";
        $sqlPC="UPDATE members SET PCurrent = '$PC' WHERE members.Id = 1;";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        $resultPD=mysqli_query($connection,$sqlPD) or die(mysqli_error($connection));
        $resultPC=mysqli_query($connection,$sqlPC) or die(mysqli_error($connection));      
        header("Location:../profile.php");

    break;
    
    case "deleteComment":
        $sql="DELETE FROM comments WHERE id=$id";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../openPost.php?action=".$userId."");

    break;
    
    case "banUser":
        $sql="UPDATE members SET Banned = 1 WHERE Id = $id;";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../moderator.php?action=user");

    break;
        
    case "deleteUser":
        $sql="DELETE FROM members WHERE Id = $id;";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../moderator.php?action=ban");

    break;

    case "deleteMe":
        $sql="DELETE FROM members WHERE Id = $id;";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        session_start();
        session_unset();
        session_destroy();
        header("Location:../index.php");
        exit();
    break;

    case "unbanUser":
        $sql="UPDATE members SET Banned = 0 WHERE Id = $id;";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../moderator.php?action=ban");

    break;
    
    case "modUser":
        $sql="UPDATE members SET Moderator = 1 WHERE Id = $id;";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../admin.php?action=user");

    break;
    
    case "unmodUser":
        $sql="UPDATE members SET Moderator = 0 WHERE Id = $id;";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../admin.php?action=mod");

    break;

    case "comment":
        $postId = $_GET["PostId"];
        $memberId = $_SESSION["u_id"];
        $content = $_POST["content"];
        $sql="INSERT INTO `comments` (`Id`, `MemberId`, `PostId`, `Content`) VALUES (NULL, $memberId, $postId, '$content');";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../openPost.php?action=".$postId."");

    break;

    case "favorite":
        $postId = $_GET["id"];
        $memberId = $_SESSION["u_id"];
        $sql="INSERT INTO `favorite` (`Id`, `MemberId`, `PostId`) VALUES (NULL, $memberId, $postId);";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../favorite.php");

    break;

    case "unFavorite":
        $postId = $_GET["id"];
        $memberId = $_SESSION["u_id"];
        $sql="DELETE FROM favorite WHERE PostId=$postId AND MemberId=$memberId;";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../favorite.php");

    break;

    case "deleteReport":
        $id = $_GET["id"];
        $sql="DELETE FROM report WHERE Id=$id";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
        header("Location:../moderator.php?action=report");

    break;
    
    default:
        $postId = $_POST["postId"];
        $memberId = $_SESSION["u_id"];;
        $reason = $_POST["reason"];
        $sql="INSERT INTO report (`Id`, `MemberId`, `PostId`, `Reason`) VALUES (NULL, $memberId, $postId, '$reason');";
        $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));

        $sql = "SELECT * FROM members WHERE Id = $memberId";
        $result=mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0){
  while ($record= mysqli_fetch_array($result)){
    $Reports=$record["Reports"]+1;    
    }
}        
$sqlRep="UPDATE members SET Reports = '$Reports' WHERE members.Id =  $memberId;";
$resultRep=mysqli_query($connection,$sqlRep) or die(mysqli_error($connection));

        header("Location:../openPost.php?action=$postId");

    break;
    }
?>