<?php
require "include/header.php";
?>
<body class="d-flex flex-column">
<?php 
            switch ($language){
                case "eng":
                    echo '<form id="reg-form" action="signup.php" method="post" >
                    <div class="card text-center col-8 offset-2">
                        <div class="">
                            <input type="text" class="col-12 form-control text-center" id="inputname" placeholder="Username" name="Username" style="margin-top: 20px; margin-bottom: 10px">
                            <span id="id_error" class="error"></span><br>
                        </div>
                        <div class="">
                            <input type="password" class="col-12 form-control  text-center" id="inputsifra" placeholder="Password" name="Password" style="margin-bottom: 10px">
                            <span id="pass_error" class="error"></span><br>
                        </div>
                        <div class="">
                            <input type="password" class="col-12 form-control  text-center" id="inputpsifra" placeholder="Repeat password" name="RepeatPass" style="margin-bottom: 10px">
                            <span id="rpass_error" class="error"></span><br>
                        </div>
                        <div class="">
                            <input type="text" class="col-12 form-control  text-center" id="inputemail" placeholder="Email" name="Email" style="margin-bottom: 10px">
                            <span id="email_error" class="error"></span><br>
                        </div>
                        <div class="">
                            <input type="text" class="col-12 form-control  text-center" id="inputtelefon" placeholder="Phone" name="Phone" style="margin-bottom: 10px">
                            <span id="phone_error" class="error"></span><br>
                        </div>
                            <span id="all_error" class="error" style="margin-bottom: 10px; margin-top:30px"></span>
                            <input type="submit" class="btn btn-primary btn-lg" name="register" value="Register" style="margin-bottom: 10px">
                            <input type="reset" class="btn btn-primary btn-lg" name="reset" value="Reset" style="margin-bottom: 20px;">
                    </div> 
                </form>
            <div class="flex-grow"></div>';
                    break;

                case "srb":
                    echo '<form id="reg-form" action="signup.php" method="post" >
                    <div class="card text-center col-8 offset-2">
                        <div class="">
                            <input type="text" class="col-12 form-control text-center" id="inputname" placeholder="Korisni??ko ime" name="Username" style="margin-top: 20px; margin-bottom: 10px">
                            <span id="id_error" class="error"></span><br>
                        </div>
                        <div class="">
                            <input type="password" class="col-12 form-control  text-center" id="inputsifra" placeholder="??ifra" name="Password" style="margin-bottom: 10px">
                            <span id="pass_error" class="error"></span><br>
                        </div>
                        <div class="">
                            <input type="password" class="col-12 form-control  text-center" id="inputpsifra" placeholder="Ponovi ??ifru" name="RepeatPass" style="margin-bottom: 10px">
                            <span id="rpass_error" class="error"></span><br>
                        </div>
                        <div class="">
                            <input type="text" class="col-12 form-control  text-center" id="inputemail" placeholder="E-mail" name="Email" style="margin-bottom: 10px">
                            <span id="email_error" class="error"></span><br>
                        </div>
                        <div class="">
                            <input type="text" class="col-12 form-control  text-center" id="inputtelefon" placeholder="Telefon" name="Phone" style="margin-bottom: 10px">
                            <span id="phone_error" class="error"></span><br>
                        </div>
                            <span id="all_error" class="error" style="margin-bottom: 10px; margin-top:30px"></span>
                            <input type="submit" class="btn btn-primary btn-lg" name="register" value="Registruj" style="margin-bottom: 10px">
                            <input type="reset" class="btn btn-primary btn-lg" name="reset" value="Resetuj" style="margin-bottom: 20px;">
                    </div> 
                </form>
            <div class="flex-grow"></div>';
                    break;
}
?>
</body>
</html>
<?php
require "include/footer.php";
?>