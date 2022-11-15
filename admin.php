<?php
ob_start();
if ((isset($_GET["action"]) and $_GET["action"]!="update2" and $_GET["action"]!="insert2" and $_GET["action"]!="delete") or isset($_GET["action"]) == false) //ovo radim zbog "Warning: Cannot modify header information - headers already sent by (output started at C:\wamp64\www\onlineShop\header.php:151) in C:\wamp64\www\onlineShop\cart.php on line 16"
    require "include/header.php";
require "include/db_config.php";
if (isset($_SESSION['u_admin'])) {
    if(!$_SESSION['u_admin']==1){
        header("Location:index.php");
    }
}
else
{
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';//This causes the browser to open the new page after 0 seconds, i.e immediately.
}

$action="";
if(isset($_GET["action"]))
    $action=$_GET["action"];
    $id=$_SESSION['u_id'];
switch ($action){

    case "user":

        $url ="admin.php?action=user";
        $search = "Username";
        form($url,$search);

            echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
            $sql="SELECT * FROM members WHERE Moderator !=1";
            
            if(!empty($_POST["name"])){
                $where="";
                
                if(!empty($_POST['name'])){
                  $t=explode(" ",$_POST["name"]);
                  foreach ($t as $k1=>$t1){
                      if($k1>0)
                          $where.=" or ";
                      $where.=" AND members.Username like '%".$t1."%'";
                
                  }
                }
               
                $sql.=$where;
                }
                  $sort="";
                  if (isset($_POST['sort'])) {
                  $sort = $_POST['sort'];
                  if ($sort=="rise"){
                    $sql.=" ORDER BY id ASC";
                  }else{
                    $sql.=" ORDER BY id DESC";
                  }
                  }
                
            
            $result=mysqli_query($connection,$sql);
            if(mysqli_num_rows($result)>0){
                echo "<div class='row col-7 justify-content-start bg-dark border' style='overflow:auto; height:45vh;' >";
              while ($record= mysqli_fetch_array($result)){
                echo "
                  <div class='row col-12 align-self-center bg-dark border mx-0 px-0'>
                  <div class='col-9 align-self-center' style='color: whitesmoke'>".$record["Username"]."</div>
                  <button class=\"btn btn-info col-3 mx-0 px-0 border\" onclick=\"window.location.href='include/update.php?action=modUser&id=".$record["Id"]."'\">Mod</button>
                    </div>";
                }
                    echo "</div>";
                }
            mysqli_free_result($result);
            echo "</div>";
            break;

    case "mod":


        $url ="admin.php?action=mod";
        $search = "Username";
        form($url,$search);
                    echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
            $sql="SELECT * FROM members WHERE Moderator =1 AND Admin !=1";
            
            if(!empty($_POST["name"])){
                $where="";
                
                if(!empty($_POST['name'])){
                  $t=explode(" ",$_POST["name"]);
                  foreach ($t as $k1=>$t1){
                      if($k1>0)
                          $where.=" or ";
                      $where.=" AND members.Username like '%".$t1."%'";
                
                  }
                }
               
                $sql.=$where;
                }
                  $sort="";
                  if (isset($_POST['sort'])) {
                  $sort = $_POST['sort'];
                  if ($sort=="rise"){
                    $sql.=" ORDER BY id ASC";
                  }else{
                    $sql.=" ORDER BY id DESC";
                  }
                  }
                
            
            $result=mysqli_query($connection,$sql);
            if(mysqli_num_rows($result)>0){
                echo "<div class='row col-7 justify-content-start bg-dark border' style='overflow:auto; height:45vh;' >";
              while ($record= mysqli_fetch_array($result)){
                echo "
                  <div class='row col-12 align-self-center bg-dark border mx-0 px-0'>
                  <div class='col-9 align-self-center' style='color: whitesmoke'>".$record["Username"]."</div>
                  <button class=\"btn btn-info col-3 mx-0 px-0 border\" onclick=\"window.location.href='include/update.php?action=unmodUser&id=".$record["Id"]."'\">Unmod</button>
                    </div>";          
                }
                    echo "</div>";
                }
            mysqli_free_result($result);
            echo "</div>";

       break;

    default:

    $url ="admin.php?action=user";
    $search = "Username";
    form($url,$search);

        echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
        $sql="SELECT * FROM members WHERE Moderator !=1";
        
        if(!empty($_POST["name"])){
            $where="";
            
            if(!empty($_POST['name'])){
              $t=explode(" ",$_POST["name"]);
              foreach ($t as $k1=>$t1){
                  if($k1>0)
                      $where.=" or ";
                  $where.=" AND members.Username like '%".$t1."%'";
            
              }
            }
           
            $sql.=$where;
            }
              $sort="";
              if (isset($_POST['sort'])) {
              $sort = $_POST['sort'];
              if ($sort=="rise"){
                $sql.=" ORDER BY id ASC";
              }else{
                $sql.=" ORDER BY id DESC";
              }
              }
            
        
        $result=mysqli_query($connection,$sql);
        if(mysqli_num_rows($result)>0){
            echo "<div class='row col-7 justify-content-start bg-dark border' style='overflow:auto; height:45vh;' >";
          while ($record= mysqli_fetch_array($result)){
            echo "
              <div class='row col-12 align-self-center bg-dark border mx-0 px-0'>
              <div class='col-9 align-self-center' style='color: whitesmoke'>".$record["Username"]."</div>
              <button class=\"btn btn-info col-3 mx-0 px-0 border\" onclick=\"window.location.href='include/update.php?action=modUser&id=".$record["Id"]."'\">Mod</button>
                </div>";
            }
                echo "</div>";
            }
        mysqli_free_result($result);
        echo "</div>";
    break;
}
?>
