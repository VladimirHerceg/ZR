<?php
require "include/header.php";
?>
<body class="d-flex flex-column">
<?php 
            switch ($language){
                case "eng":
                    echo '<div class="d-flex justify-content-center">
                    <div class="card text-center col-10 col-sm-6 col-lg-3" style="margin-top:45px">
                    
                    <form id="log-form" name="log-form" action="login.php" method="post">
                                    <div class="text-center col-8 offset-2">
                                    <div class="">
                                        <input type="text" class="col-12 form-control text-center" id="userLogin" placeholder="Username" name="username" style="margin-top: 20px; margin-bottom: 10px">
                                        <span id="id_error" class="error"></span><br>
                                        </div>
                                       <div class="">
                                            <input type="password" class="col-12 form-control  text-center" id="passLogin" placeholder="Password" name="password" style="margin-bottom: 10px">
                                            <span id="pass_error" class="error"></span><br>
                                        </div>
                                        <div class="">
                                        <input class="col-6 mx-0 px-0 border" type="text" id="code" name="code" size="8">
                                        <img class="col-4 mx-0 px-0" src="include/captcha.php" border="0" alt="code">
                                        <span id="code_error" class="error"></span><br>
                                        </div>
                                        <span id="all_error" class="error" style="margin-bottom: 10px; margin-top:30px"></span>
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-lg" name="logIn" value="Login" style="margin-bottom: 10px">
                                    </div> 
                                </form>
                    
                    </div>
                    </div>';
                    break;
                case "srb":
                    echo '<div class="d-flex justify-content-center">
                    <div class="card text-center col-10 col-sm-6 col-lg-3" style="margin-top:45px">
                    
                    <form id="log-form" name="log-form" action="login.php" method="post">
                                    <div class="text-center col-8 offset-2">
                                    <div class="">
                                        <input type="text" class="col-12 form-control text-center" id="userLogin" placeholder="Korisničko ime" name="username" style="margin-top: 20px; margin-bottom: 10px">
                                        <span id="id_error" class="error"></span><br>
                                        </div>
                                       <div class="">
                                            <input type="password" class="col-12 form-control  text-center" id="passLogin" placeholder="Šifra" name="password" style="margin-bottom: 10px">
                                            <span id="pass_error" class="error"></span><br>
                                        </div>
                                        <div class="">
                                        <input class="col-6 mx-0 px-0 border" type="text" id="code" name="code" size="8">
                                        <img class="col-4 mx-0 px-0" src="include/captcha.php" border="0" alt="code">
                                        <span id="code_error" class="error"></span><br>
                                        </div>
                                        <span id="all_error" class="error" style="margin-bottom: 10px; margin-top:30px"></span>
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-lg" name="logIn" value="Uloguj se" style="margin-bottom: 10px">
                                    </div> 
                                </form>
                    
                    </div>
                    </div>';
                    break;
}
?>
<div class='flex-wrapper col-12 mx-0 px-0 row border-white' style='display: flex;
   min-height: calc(100vh - 400px);
  flex-direction: column;
  justify-content: space-between'>
<div class='flex-grow'></div>
</body>
</html>
<?php
include "include/footer.php";
?>