<?php
require "include/header.php";
$url = "posts.php";
switch ($language){
  case "eng":
    $search = "Title";
    break;
  case "srb":
    $search = "Titl";
    break;
}
?>
<body class="d-flex flex-column min-vh-100">
<?php
form($url,$search,$language);
echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
$sql="SELECT posts.Id as Id, posts.Title as title FROM posts";

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
    
      <div class='col-12 align-self-center bg-dark border'><a style='color: whitesmoke; text-decoration: none;' href='openPost.php?action=".$record["Id"]."'>".$record["title"]."</a></div>";
        }
        echo "</div>";
    }
mysqli_free_result($result);
echo "</div>";
?>
 
</body>
</html>
<?php
require "include/footer.php";
?>