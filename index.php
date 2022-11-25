<?php
require "include/header.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta property="og:title" content="Ani Forum"/>
        <meta property="og:type" content="Forum" />
        <meta property="og:url" content="index.php"/>
        <meta property="og:site_name" content="Forum"/>
        <meta property="og:description" content="On our Forum you can discuss animals"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="This is a College project for Subotica Tech">
        <meta name="robots" content="index, follow">
        <meta name="author" content="Vladimir">
        <meta name="keywords" content="Ani Forum,Forum,Animal Forum,Animals,Životinje,Forum za Životinjama">
        <meta http-equiv="content-type" content="text/image/html">
        <meta http-equiv="content-language" content="rs">
<body class="d-flex flex-column">
<div class="cnt container-fluid mx-0 px-0">

</div>
<div class='flex-grow'>
<div class="container-fluid">
<div class="row justify-content-center text-center">


<?php

$checkSql = "SELECT * FROM posts;";
$checkResult=mysqli_query($connection,$checkSql);

if(mysqli_num_rows($checkResult) >0){

$maxSql = "SELECT MAX(Id) FROM posts;";
$maxResult=mysqli_query($connection,$maxSql);
if(mysqli_num_rows($maxResult)>0){
    while ($maxRecord= mysqli_fetch_array($maxResult)){

$max=$maxRecord["MAX(Id)"];
    

$sql = "SELECT * FROM posts WHERE Id = $max";
$result=mysqli_query($connection,$sql);
if(mysqli_num_rows($result)>0){
  while ($record= mysqli_fetch_array($result)){

      $id2=$record['MemberId'];
      $sql2 = "SELECT * FROM members WHERE Id = $id2";

      $result2=mysqli_query($connection,$sql2);
      if(mysqli_num_rows($result2)>0){
          while ($record2= mysqli_fetch_array($result2)){
              
              echo"
              <div class='col-6 bg-dark'><a style='color: whitesmoke; text-decoration: none;' href='openPost.php?action=".$record["Id"]."'>".$record["Title"]."</a></div>
              <div class='col-2 bg-dark'>".$record["Date"]."</div>
              <div class='col-2 bg-dark' style='  font-weight: bold;'><a href='profile.php?action=".$record["MemberId"]."'>".$record2["Username"]."</a></div>
              <div class='col-10 bg-dark'><img alt='Ne postoji slika' src='images/posts/posts(resized)/".$record["Image"]."' width='60%'> </div>
              <div class='col-10 bg-dark'>".$record["Content"]."</div>";    
                  
          }
          }
        }
    }

}
}
}
else
switch ($language){
    case "eng":
        echo "No posts";
        break;
    case "srb":
        echo "Nema postova";
        break;
}
?>

</div>
</div>
</div>
</body>
    </head>
</html>
<?php
    require "include/footer.php";
?>