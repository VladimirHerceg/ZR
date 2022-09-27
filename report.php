<?php
ob_start();
if(!isset($_GET["action"]) || !isset($_GET["id"]) || !is_numeric($_GET["action"]) || !is_numeric($_GET["id"])){
    header("Location:index.php");
}else if (isset($_GET["action"])) {
    include "include/db_config.php";

    $check = $_GET["action"];
    $sqlCheck = "SELECT * FROM posts WHERE Id = $check";
$resultCheck=mysqli_query($connection,$sqlCheck);
if (mysqli_num_rows($resultCheck)===0) {
    header("Location:index.php");
}
require "include/header.php";
$action="";
if(isset($_GET["action"]))
    $action=$_GET["action"];
$id="";
if(isset($_SESSION['u_id']))
$id=$_SESSION['u_id'];

?>

<form id="report-form" action="include/update.php?" method="post" enctype="multipart/form-data">
<div class="container-fluid mx-0 px-0">
<input type="hidden" id="postId" name="postId" value="<?php echo $action?>">
<input type="hidden" id="memberId" name="memberId" value="<?php$id?>">
    <div class="row justify-content-center mx-0 px-0" style="margin-top: 35px">  
                <div class="col-12">
                  <label for="reason"></label>
                  <input type="text" class="form-control  text-center" id="reason" placeholder="Razlog" name="reason">
                </div>
                
                <div class="col-12 text-center">
                <span id="all_error" class="error"></span><br><br>
                </div>
            <input type="submit" class="btn btn-info col-3" value="Dodaj">
        </form>
        </div>
        </div>
<?php
}
?>