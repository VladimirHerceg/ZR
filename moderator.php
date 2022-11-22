<?php
ob_start();
    require "include/header.php";
require "include/db_config.php";
if (isset($_SESSION['u_moderator'])) {
    if(!$_SESSION['u_moderator']==1){
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
$id="";
if(isset($_GET["id"]))
    $id=$_GET["id"];

switch ($action){
    case "post":
        $url ="moderator.php?action=post";
        $search = "Titl";
        form($url,$search);

            echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
            $sql="SELECT posts.Id as Id, posts.Title as title FROM posts ";
            
           
if(!empty($_POST["name"])){
    $where="";
    
    if(!empty($_POST['name'])){
      $t=explode(" ",$_POST["name"]);
      foreach ($t as $k1=>$t1){
          if($k1>0)
              $where.=" or ";
          $where.=" posts.Title like '%".$t1."%'";
    
      }
      if(count($t)>0)
          $where="($where)";
    }
    $where = " where " . $where;
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
                    <div class='col-9 align-self-center'><a style='color: whitesmoke; text-decoration: none;' href='openPost.php?action=".$record["Id"]."'>".$record["title"]."</a></div>
                    <button class=\"btn btn-info col-3 align-self-center border\" onclick=\"window.location.href='include/update.php?action=post&id=".$record["Id"]."'\">Obrisi</button>
                    </div>";
                  
                    }
                    echo "</div>";
                }
            mysqli_free_result($result);
            echo "</div>";

        break;


    case "user":
        $url ="moderator.php?action=user";
        $search = "Korisničko ime";
        form($url,$search);
            echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
            $sql="SELECT * FROM members WHERE Moderator !=1 AND Banned !=1";
            
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
                    <div class='col-9 align-self-center'><a style='color: whitesmoke; text-decoration: none;' href='profile.php?action=".$record["Id"]."'>".$record["Username"]."</a></div>
                    <button class=\"btn btn-info col-3 align-self-center mx-0 px-0 border\" onclick=\"window.location.href='include/update.php?action=banUser&id=".$record["Id"]."'\">Ban</button>
                    </div>";
                 }
                    echo "</div>";
                }
            mysqli_free_result($result);
            echo "</div>";

        break;


    case "report":
        
        echo '<body class="d-flex flex-column min-vh-100">
        <form action="moderator.php?action=report" method="post" >
                <div class="container-fluid text-center text-md-left">
                    <div class="row  justify-content-center mx-0 px-0" style="margin-top: 35px">
                    <div class="rcena custom-control custom-radio text-center col-6 offset-3 col-md-2 offset-md-0" >
                            <input type="radio" class="form-input" id="rise" name="sort" value="rise">
                               <label class="form-label" style="color: whitesmoke" for="rise">Najstarije</label>
                        </div>
                        <div class="rcena custom-control custom-radio text-center col-6 offset-3 col-md-2 offset-md-0">
                            <input type="radio" class="form-input" id="fall" name="sort" value="fall">
                                <label class="form-label" style="color: whitesmoke" for="fall">Najnovije</label>
                        </div>
                    </div>
                    <div class="row">
                    <input type="submit" name="sub" class="trazib btn btn-primary col-4 offset-4 col-xl-2 offset-xl-3" value="Trazi">
                        <input type="submit" name="drop" class="ponistib btn btn-primary col-4 offset-4 col-xl-2 offset-xl-2" value="Ponisti">
                    </div> 
                </div> 
            </form>';

            echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
            $sql="SELECT * FROM report";
            
                $sort="";
                if (isset($_POST['sort'])) {
                $sort = $_POST['sort'];
                if ($sort=="rise"){
                  $sql.=" ORDER BY id ASC";
                }else{
                  $sql.=" ORDER BY id DESC";
                }
                }
                echo "<div class='row col-7 justify-content-start bg-dark border' style='overflow:auto; height:45vh; display: flex;' >";
                echo "<div class='row col-12' align-self-center style='height:5%; display: flex;'>";
                echo "
                <div class='col-4 align-self-top bg-dark border-bottom' style='color: whitesmoke;'>Post Id</div><br>
                <div class='col-4 align-self-top bg-dark border-bottom' style='color: whitesmoke;'>Razlog</div><br>
                <div class='col-4 align-self-top bg-dark border-bottom' style='color: whitesmoke;'>Obriši</div><br></div>";
            
            $result=mysqli_query($connection,$sql);
            if(mysqli_num_rows($result)>0){
              while ($record= mysqli_fetch_array($result)){

                echo "<div class='row col-12 align-self-center border-top bg-dark border mx-0 px-0'>
                <div class='col-4 align-self-center bg-dark' style='color: whitesmoke'><a href='openPost.php?action=".$record["PostId"]."'>".$record["PostId"]."</a></div><br>
                <div class='col-4 align-self-center bg-dark' style='color: whitesmoke'>".$record["Reason"]."</div><br>
                <button class=\"btn btn-info col-4 align-self-center mx-0 px-0 border\" onclick=\"window.location.href='include/update.php?action=deleteReport&id=".$record["Id"]."'\">Remove</button>
                </div>";                
                    }
                }
                echo "</div>";

                mysqli_free_result($result);
            echo "</div>";


    break;

        case "ban":

            $url ="moderator.php?action=ban";
            $search = "Korisničko ime";
            form($url,$search);

    
                echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
                $sql="SELECT * FROM members WHERE Banned =1";
                
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
                    <div class='col-9 align-self-center'><a style='color: whitesmoke; text-decoration: none;' href='profile.php?action=".$record["Id"]."'>".$record["Username"]."</a></div>
                    <div class=\"col-3 align-self-center\">
                    <div class='col-12' style='height:2vh'></div>
                    <button class=\"btn btn-info col-12 align-self-center mx-0 px-0 border\" onclick=\"window.location.href='include/update.php?action=unbanUser&id=".$record["Id"]."'\">Unban</button>
                    <div class='col-12' style='height:1vh'></div>
                    <button class=\"btn btn-info col-12 align-self-center mx-0 px-0 border\" onclick=\"window.location.href='include/update.php?action=deleteUser&id=".$record["Id"]."'\">Obriši</button>
                    <div class='col-12' style='height:2vh'></div>
                    </div></div>";    
                }
                        echo "</div>";
                    }                        

                mysqli_free_result($result);
                echo "</div>";
    
            break;

    default:

    header("Location:moderator.php?action=post");
    
    break;
}
?>
