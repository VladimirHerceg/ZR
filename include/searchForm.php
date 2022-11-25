<?php
                    function form ($url,$search,$language) {

            switch ($language){
                case "eng":
                    
   
                        echo '
                        <form action="'.$url.'" method="post" >
                            <div class="container-fluid text-center text-md-left">
                                <div class="row justify-content-center mx-0 px-0" style="margin-top: 35px">
                                <div class="col-8 col-sm-4 offset-sm-1 col-md-2 offset-md-1">
                                        <input type="text" name="name" class="form-control text-center" placeholder="'.$search.'" aria-label="name" aria-describedby="basic-addon1">
                                    </div>
                                <div class="rcena custom-control custom-radio text-center col-6 offset-3 col-md-2 offset-md-1" >
                                        <input type="radio" class="form-input" id="rise" name="sort" value="rise">
                                           <label class="form-label" style="color: whitesmoke" for="rise">Oldest</label>
                                    </div>
                                    <div class="rcena custom-control custom-radio text-center col-6 offset-3 col-md-2 offset-md-0">
                                        <input type="radio" class="form-input" id="fall" name="sort" value="fall">
                                            <label class="form-label" style="color: whitesmoke" for="fall">Newest</label>
                                    </div>
                                </div>
                                <div class="row">
                                <input type="submit" name="sub" class="trazib btn btn-primary col-4 offset-4 col-md-2 offset-md-3" value="Search">
                                    <input type="submit" name="drop" class="ponistib btn btn-primary col-4 offset-4 col-md-2 offset-md-2" value="Cancel">
                                </div> 
                            </div> 
                        </form>
                        ';
                    

                break;
                case "srb":
                
   
                        echo '
                        <form action="'.$url.'" method="post" >
                            <div class="container-fluid text-center text-md-left">
                                <div class="row justify-content-center mx-0 px-0" style="margin-top: 35px">
                                <div class="col-8 col-sm-4 offset-sm-1 col-md-2 offset-md-1">
                                        <input type="text" name="name" class="form-control text-center" placeholder="'.$search.'" aria-label="name" aria-describedby="basic-addon1">
                                    </div>
                                <div class="rcena custom-control custom-radio text-center col-6 offset-3 col-md-2 offset-md-1" >
                                        <input type="radio" class="form-input" id="rise" name="sort" value="rise">
                                           <label class="form-label" style="color: whitesmoke" for="rise">Najstarije</label>
                                    </div>
                                    <div class="rcena custom-control custom-radio text-center col-6 offset-3 col-md-2 offset-md-0">
                                        <input type="radio" class="form-input" id="fall" name="sort" value="fall">
                                            <label class="form-label" style="color: whitesmoke" for="fall">Najnovije</label>
                                    </div>
                                </div>
                                <div class="row">
                                <input type="submit" name="sub" class="trazib btn btn-primary col-4 offset-4 col-md-2 offset-md-3" value="Traži">
                                    <input type="submit" name="drop" class="ponistib btn btn-primary col-4 offset-4 col-md-2 offset-md-2" value="Poništi">
                                </div> 
                            </div> 
                        </form>
                        ';
                    
                    
                break;
}
                    }

?>