<link href="css/style.css" rel="stylesheet">
<footer class="col-12 page-footer pt-4 navbar-light bg-light mt-auto" style="color: #000;">
    <div class="container-fluid text-center text-md-left">
        <div class="row text-center">
            <div class="col-md-4">
                <h5 class="text-uppercase">Ani Forum</h5>
                <p>Forum za pronalaženje i spašavanje životinja</p>
                </div>
            <hr class="clearfix w-100 d-md-none pb-3">
            <div class="col-md-4 mb-md-0 mb-3">
                <h5 class="text-uppercase">KONTAKT</h5>
                <ul class="list-unstyled">
                    <li>
                        <p><i class="fas fa-home"></i> Subotica</p>
                    </li>
                    <li>
                        <p><i class="fas fa-envelope-square"></i> aniforum@gmail.com</p>
                    </li>
                    <li>
                        <p><a class="fas fa-phone" href="tel:+024548779" style="color: #000; text-decoration: none"> 063-750 9033</a></p>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 mb-md-0 mb-3">



            <?php 


            switch ($language){
            
                case "eng":
            
            echo ' <h5 class="text-uppercase">USEFUL LINKS</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="index.php " style="color: #000; text-decoration: none">Homepage</a>
                    </li>
                    <li>
                        <a href="posts.php" style="color: #000; text-decoration: none">Posts</a>
                    </li>
                </ul>';
                 
                break;

                case "srb":

            echo '<h5 class="text-uppercase">KORISNI LINKOVI</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="index.php " style="color: #000; text-decoration: none">Početna</a>
                    </li>
                    <li>
                        <a href="posts.php" style="color: #000; text-decoration: none">Postovi</a>
                    </li>
                </ul>';

                break;
            }
            ?>
            </div>
        </div>
    </div>
</footer>
