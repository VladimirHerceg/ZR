<?php
if (!isset($_GET['action']) || !is_numeric($_GET["action"])) {
    header("Location:index.php");
}
else if (isset($_GET["action"])) {
    include "include/db_config.php";

    $check = $_GET["action"];
    $sqlCheck = "SELECT * FROM posts WHERE Id = $check";
$resultCheck=mysqli_query($connection,$sqlCheck);
if (mysqli_num_rows($resultCheck)===0) {
    header("Location:index.php");
}
require "include/header.php";


echo '<body class="d-flex flex-column min-vh-100">
<div class="container-fluid">
<div class="row justify-content-center text-center">';

    $id = $_GET["action"];

    

    $moderator="";
    if (isset($_SESSION['u_moderator']))
    $moderator = $_SESSION['u_moderator'];
    
    $sessId="";
    if (isset($_SESSION['u_id']))
    $sessId = $_SESSION['u_id'];
$postSql = "SELECT *, posts.Id as postId FROM `posts` INNER JOIN members ON members.Id=posts.MemberId WHERE posts.Id=$id;";


$postResult=mysqli_query($connection,$postSql);
if(mysqli_num_rows($postResult)>0){
    while ($post= mysqli_fetch_array($postResult)){    
        
               
        echo"<div class='col-3 bg-dark dropdown'>
                <a class='nav-link dropdown-toggle' style='color:whitesmoke;' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        ...
    </a>
    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>";

    if(isset($_SESSION['u_id'])){
        echo "<a class='dropdown-item' href='report.php?id=".$sessId."&action=".$post["postId"]."'>Report</a>";
        $fpid = $post["postId"];
        $fmid = $post["MemberId"];
        $favSql = "SELECT * FROM favorite WHERE MemberId = $sessId AND PostId = $fpid;";  
        $favres=mysqli_query($connection,$favSql);
        if(mysqli_num_rows($favres) == 0){
            echo "<a class='dropdown-item' href='include/update.php?action=favorite&id=".$post["postId"]."'>Favorite</a>";
        }
}
if($sessId == $post["MemberId"] or $moderator == 1){
    echo "<a class='dropdown-item' href='include/update.php?action=deleteMyPost&id=".$post["postId"]."'>Delete</a>";
}

    echo "</div>
                </div>
                <div class='col-3 bg-dark'>".$post["Title"]."</div>
                <div class='d-none d-md-block col-md-2 bg-dark'>".$post["Date"]."</div>
                <div class='col-4 col-md-2 bg-dark' style='  font-weight: bold;'><a href='profile.php?action=".$post["MemberId"]."'>".$post["Username"]."</a></div>
                <div class='col-10 bg-dark'><img alt='Ne postoji slika' src='images/posts/posts(resized)/".$post["Image"]."' width='60%'> </div>
                <div class='col-10 bg-dark'>".$post["Content"]."</div>
                <div class='col-12' style='height:1vh'></div>";              

        $commentSql = "SELECT *, comments.Id as commentId FROM comments INNER JOIN members ON members.Id=comments.MemberId WHERE comments.PostId=$id;";

        $commentResult=mysqli_query($connection,$commentSql);
        if(mysqli_num_rows($commentResult)>0){
            while ($comment= mysqli_fetch_array($commentResult)){

                        if($sessId == $comment["MemberId"] or $moderator == 1){
                        echo"
                        <div class='col-12' style='height:1vh'></div>
                        <div class='row col-12 justify-content-center'>
                        <div class='col-1 bg-dark border' style='font-weight: bold;'><a href='profile.php?action=".$comment["Id"]."'>".$comment["Username"]."</a></div>
                        <div class='col-7 bg-dark border'>".$comment["Content"]."</div>
                        <button class=\"btn btn-info col-2 mx-0 px-0 border\" style='height:5vh' onclick=\"window.location.href='include/update.php?id2=".$post["postId"]."&action=deleteComment&id=".$comment["commentId"]."'\">Delete</button></div>";
                    }
                    else{
                        echo"
                        <div class='col-12' style='height:1vh'></div>
                        <div class='row col-12 justify-content-center'>
                        <div class='col-1 bg-dark border' style='  font-weight: bold;'><a href='profile.php?action=".$comment["MemberId"]."'>".$comment["Username"]."</a></div>
                        <div class='col-9 bg-dark border'>".$comment["Content"]."</div></div>
                        ";    
                    
                    }
                }
                }        
                
            }
        }
        
        
}
if(isset($_SESSION['u_id']))
echo '
<form id="comment-form" action="include/update.php?action=comment&PostId='.$id.'" method="post" enctype="multipart/form-data">
    <div class="row justify-content-center mx-0 px-0" style="margin-top: 35px">  
                <div class="col-8">
                  <label for="content"></label>
                  <textarea style="height:vh50;resize: none;" class="form-control  text-center" id="content" placeholder="Komentar" name="content"></textarea>
                </div>
                <input type="submit" class="btn btn-info col-2" style="height:vh1" value="Komentarisi">
                </div>
    <span id="all_error" class="error"></span><br><br>
        </form>
        </div>';
?>
</div>
</div>
</body>
</html>
<?php
require "include/footer.php";

?>