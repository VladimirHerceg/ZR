<?php
require "include/header.php";

if(isset($_SESSION['u_id'])) {

  switch ($language){
    case "eng":
      $search = "Title";
      break;
    case "srb":
      $search = "Titl";
        break;
}

  $url ="favorite.php?action=post";
  echo '<body class="d-flex flex-column min-vh-100">';
  form($url,$search,$language);
      

            echo "<div class='row justify-content-center text-center flex-grow text-light mx-0 px-0' style='margin-top:75px'>";
            $sql="SELECT posts.Id as Id, posts.Title as title FROM posts INNER JOIN favorite ON favorite.PostId=posts.Id WHERE favorite.MemberId=".$_SESSION["u_id"];         
            
            if(!empty($_POST["name"])){
              $where="";
              
              if(!empty($_POST['name'])){
                $t=explode(" ",$_POST["name"]);
                foreach ($t as $k1=>$t1){
                    if($k1>0)
                        $where.=" or ";
                    $where.=" AND posts.Title like '%".$t1."%'";
              
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
                echo "<div class='row col-7 justify-content-center bg-dark border' style='overflow:auto; height:45vh;' >";
              while ($record= mysqli_fetch_array($result)){

                switch ($language){
                  case "eng":
                      echo "
                <div class='row col-12 align-self-center bg-dark border'>
                  <div class='col-9 align-self-center'><a style='color: whitesmoke; text-decoration: none;' href='openPost.php?action=".$record["Id"]."'>".$record["title"]."</a></div>
                  <button class=\"btn btn-info col-3 align-self-center mx-0 px-0 border\" onclick=\"window.location.href='include/update.php?action=unFavorite&id=".$record["Id"]."'\">Remove from favorite</button>
                  </div>";
                      break;
                  case "srb":
                    echo "
                    <div class='row col-12 align-self-center bg-dark border'>
                      <div class='col-9 align-self-center'><a style='color: whitesmoke; text-decoration: none;' href='openPost.php?action=".$record["Id"]."'>".$record["title"]."</a></div>
                      <button class=\"btn btn-info col-3 align-self-center mx-0 px-0 border\" onclick=\"window.location.href='include/update.php?action=unFavorite&id=".$record["Id"]."'\">Izbaci iz omiljenog</button>
                      </div>";
                      break;
  }                  
                    }
                    echo "</div>";
                }
            mysqli_free_result($result);
            echo "</div>";
              }
              else {
                header('Location:index.php');
            }
              
            require "include/footer.php";

?>