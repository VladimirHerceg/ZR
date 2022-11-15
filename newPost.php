<?php
require "include/header.php";
if(isset($_SESSION['u_id'])) {
echo '<body class="d-flex flex-column min-vh-100">
<form id="insert-form" action="include/insertPost.php" method="post" enctype="multipart/form-data">
<div class="container-fluid mx-0 px-0">
    <div class="row justify-content-center mx-0 px-0" style="margin-top: 35px">  
                <div class="col-12">
                  <label for="title"></label>
                  <input type="text" class="form-control  text-center" id="title" placeholder="Titl" name="title">
                </div>
                <span class="col-10 offset-1 text-center" style="color: #E75E80" id="title_error" class="error"></span><br>
                
                <div class="col-12">
                  <label for="content"></label>
                  <textarea class="form-control  text-center" id="content" placeholder="Sadrzaj" name="content"></textarea>
                </div>
                <span class="col-10 offset-1 text-center" style="color: #E75E80" id="content_error" class="error"></span><br>
                <div class="col-12 justify-content-center text-center">
                <div class="col-10 text-center"></div>
                <label class="col-1 text-dark bg-light" for="image">Klikni ovde da izabereš sliku</label>
                <div class="col-10 text-center"></div>
                            <input style="visibility:hidden;" type="file" name="file" id="image" accept="image/jpeg">
      <span id="image_error" class="error"></span><br><br>
     <span id="all_error" class="error"></span><br><br>
    </div>
            <input type="submit" class="btn btn-info col-3" value="Dodaj">
        </form>
        </div>
        </div>';
    }
    else {
      header('Location:index.php');
  }

?>
</body>
<?php
require "include/footer.php";
