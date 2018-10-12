<nav>
    <div class="mainContainer">
        <div class="">

            <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-end align-items-end">
                <div class="d-flex flex-row justify-content-between">
                    <a class="navbar-brand col-8 p-0" href="#">
                        <img style="width: 100%; height:100%;" src="imgs/GezinshuisRegterink_logo_breed.png"
                             alt="logo"/>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>


                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <div class="navbar-nav w-100 text-right pr-3">
                        <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link" href="#">Over</a>
                        <a class="nav-item nav-link" href="#">Contact</a>
                    </div>
                </div>
            </nav>
        </div>

<!--        <div class="row">-->
<!--            <div class="col col-sm-4">-->
<!--                <a href="/"> <img style="width: 100%; height:100%;" src="imgs/GezinshuisRegterink_logo_breed.png"-->
<!--                                  alt="logo"/></a>-->
<!--            </div>-->
<!--            <div class="col-sm-8">-->
<!---->
<!--                <div class="flexContainer">-->
<!--                    <a class="navLink nav-link" href="/">Home</a>-->
<!--                    <a class="navLink nav-link" href="/about">About us</a>-->
<!--                    <a class="navLink nav-link" href="/contact">Contact</a>-->
<!--                    <a class="navLink nav-link" href="/upload">Upload</a>-->
<!--                    --><?php
//                    $loggedIn = \Qui\lib\facades\Authentication::verify();
//                    $user = \Qui\lib\facades\Authentication::verify(true);
//                    // if NOT logged in
//                    if (!$loggedIn) {
//                        echo "<a class=\"navLink nav-link\" href=\"/login\">Login</a>";
//                        echo "<a class=\"navLink nav-link\" href=\"/register\">Register</a>";
//                    }
//                    // if logged in
//                    if ($loggedIn) {
//                        echo "<a class=\"navLink nav-link\" href=\"/logout\">Logout</a>";
//                        echo "<a class=\"navLink nav-link\" href=\"#\">Hi, {$user['fname']}!</a>";
//                    }
//                    ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</nav>