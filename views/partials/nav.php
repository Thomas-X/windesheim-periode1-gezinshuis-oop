<nav>
    <div class="mainContainer">
        <div class="row">
            <div class="col col-sm-4">
                <a href="/"> <img style="width: 100%; height:100%;" src="imgs/GezinshuisRegterink_logo_breed.png"
                                  alt="logo"/></a>
            </div>
            <div class="col-sm-8">

                <div class="flexContainer">
                    <a class="navLink nav-link" href="/">Home</a>
                    <a class="navLink nav-link" href="/about">About us</a>
                    <a class="navLink nav-link" href="/contact">Contact</a>
                    <?php
                    $loggedIn = \Qui\core\facades\Auth::verify();
                    $user = \Qui\core\facades\Auth::verify(true);
                    // if NOT logged in
                    if (!$loggedIn) {
                        echo "<a class=\"navLink nav-link\" href=\"/login\">Login</a>";
                    }
                    // if logged in
                    if ($loggedIn) {
                        echo "<a class=\"navLink nav-link\" href=\"/logout\">Logout</a>";
                        echo "<a class=\"navLink nav-link\" href=\"#\">Hi, {$user['fname']}!</a>";
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>
</nav>