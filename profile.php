<?php
if (!isset($_GET["action"]) || empty($_GET["action"]))
header("Location: index.php");
require "include/header.php";

$stats="";
if (isset($_GET["stats"]))
$stats = $_GET["stats"]; 
switch ($stats) {
  case "stats":

    $id ="";
    $moderator="";
    if(isset($_SESSION['u_id']))
    {
        $id = $_SESSION['u_id'];
        $moderator = $_SESSION['u_moderator'];
    }
    
    if (isset($_GET["action"]))
    $action = $_GET["action"];
    $user="";
    $sql = "SELECT Username FROM members WHERE id = '$action'";
    $result=mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)>0){
    while ($record= mysqli_fetch_array($result)){
      $user = $record["Username"];
    }
  }
  mysqli_free_result($result);

    echo '<body class="d-flex flex-column min-vh-100">';
    echo '<div class="row col-1">
    <a class="nav-link col-12 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</a>
    <div class="dropdown-menu col-1" aria-labelledby="navbarDropdown">
  <a class="dropdown-item" href="profile.php?action='.$action.'">Posts</a>
  <a class="dropdown-item" href="profile.php?action='.$action.'&stats=stats">Stats</a>';
  if($id == $action)
  echo '<a class="dropdown-item" href="include/update.php?action=deleteMe&id='.$action.'">Delete profile</a>';
  else if($moderator == 1 && $id != $action)
  echo '<a class="dropdown-item" href="include/update.php?action=banUser&id='.$action.'">Ban user</a>';
  echo'</div>
  <div>'.$user.'</div></div>';
    $sql="SELECT PTotal,PCurrent,PDeleted,Reports from members where id=$action";
    $result=mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<div class='row col-7 align-self-center justify-content-center bg-dark border' style='overflow:auto; height:45vh;' >";
      while ($record= mysqli_fetch_array($result)){
          echo "
          <div class='row align-self-center bg-dark border'>
          <div class='col-3 align-self-center bg-dark '>Total posts</div>
          <div class='col-3 offset-4 align-self-center bg-dark' >".$record["PTotal"]."</div>
          </div>
          <div class='row align-self-center bg-dark border'>
          <div class='col-3 align-self-center bg-dark '>Current posts</div>
          <div class='col-3 offset-4 align-self-center bg-dark' >".$record["PCurrent"]."</div>
          </div>
          <div class='row align-self-center bg-dark border'>
          <div class='col-3 align-self-center bg-dark '>Deleted posts</div>
          <div class='col-3 offset-4 align-self-center bg-dark' >".$record["PDeleted"]."</div>
          </div>
          <div class='row align-self-center bg-dark border'>
          <div class='col-3 align-self-center bg-dark '>Reports</div>
          <div class='col-3 offset-4 align-self-center bg-dark' >".$record["Reports"]."</div>
          </div>
          </div>";
          
            }
            echo "</div>";
        }
    mysqli_free_result($result);


  break;

    default:

$id ="";
$moderator="";
if(isset($_SESSION['u_id']))
{
    $id = $_SESSION['u_id'];
    $moderator = $_SESSION['u_moderator'];
}
 if (isset($_GET["action"]))
 {
  $action = $_GET["action"];

  $user="";
  $sql = "SELECT Username FROM members WHERE id = '$action'";
  $result=mysqli_query($connection,$sql);
  if(mysqli_num_rows($result)>0){
  while ($record= mysqli_fetch_array($result)){
    $user = $record["Username"];
  }
}
mysqli_free_result($result);


  if ($id == $action) {
    

echo '<body class="d-flex flex-column min-vh-100">';
  echo '<div class="row col-1">
    <a class="nav-link dropdown-toggle col-12" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</a>
    <div class="dropdown-menu col-1" aria-labelledby="navbarDropdown">
  <a class="dropdown-item" href="profile.php?action='.$action.'">Posts</a>
  <a class="dropdown-item" href="profile.php?action='.$action.'&stats=stats">Stats</a>
  <a class="dropdown-item" href="include/update.php?action=deleteMe&id='.$action.'">Delete profile</a>';
  echo'</div>
  <div>'.$user.'</div></div>';
$url = "profile.php?action=".$action."";
form($url);



echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
$sql="SELECT posts.Id as Id, posts.Title as title FROM posts WHERE posts.MemberId = $action";

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
  $where = " && " . $where;
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
    echo "<div class='row col-7 justify-content-start bg-dark border' style='overflow:auto; height:45vh;'>";

  while ($record= mysqli_fetch_array($result)){
    echo "
    
      <div class='col-12 align-self-center bg-dark border'><a style='color: whitesmoke; text-decoration: none;' href='openPost.php?action=".$record["Id"]."'>".$record["title"]."</a></div>";
        }
        echo "</div>";
    }
mysqli_free_result($result);
echo "</div>";
}
elseif ($moderator == 1 && $id != $action) {
  echo '<body class="d-flex flex-column min-vh-100">';
echo '<div class="row col-1">
<a class="nav-link dropdown-toggle col-12" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</a>
<div class="dropdown-menu col-1" aria-labelledby="navbarDropdown">
<a class="dropdown-item" href="profile.php?action='.$action.'">Posts</a>
<a class="dropdown-item" href="profile.php?action='.$action.'&stats=stats">Stats</a>
<a class="dropdown-item" href="include/update.php?action=banUser&id='.$action.'">Ban user</a>';
echo'</div>
<div>'.$user.'</div></div>';


  $url = "profile.php?action=".$action."";
  form($url);    
    echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
    $sql="SELECT posts.Id as Id, posts.Title as title FROM posts WHERE posts.MemberId = $action";
    
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
        echo "<div class='row col-7 justify-content-start bg-dark border' style='overflow:auto; height:45vh;'>";
          while ($record= mysqli_fetch_array($result)){
        echo "
        
          <div class='col-12 align-self-center bg-dark border'><a style='color: whitesmoke; text-decoration: none;' href='openPost.php?action=".$record["Id"]."'>".$record["title"]."</a></div>";
            }
            echo "</div>";
        }
    mysqli_free_result($result);  

    echo "</div>";
}
else {
    echo '<body class="d-flex flex-column min-vh-100">';
    echo '<body class="d-flex flex-column min-vh-100">';
    echo '<div class="row col-1">
    <a class="nav-link dropdown-toggle col-12" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</a>
    <div class="dropdown-menu col-1" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="profile.php?action='.$action.'">Posts</a>
    <a class="dropdown-item" href="profile.php?action='.$action.'&stats=stats">Stats</a>';
    echo'</div>
    <div>'.$user.'</div></div>';
        $url = "profile.php?action=".$action."";
    form($url);    
      
    echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
    $sql="SELECT posts.Id as Id, posts.Title as title FROM posts WHERE posts.MemberId = $action";
    
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
        
          <div class='col-12 align-self-center bg-dark border'><a style='color: whitesmoke; text-decoration: none;' href='openPost.php?action=".$record["Id"]."'>".$record["title"]."</a></div>";
            }
            echo "</div>";
        }
    mysqli_free_result($result);
    echo "</div>";
}
 }

    break;

}
?>
 
</body>
</html>
<?php
require "include/footer.php";
?>