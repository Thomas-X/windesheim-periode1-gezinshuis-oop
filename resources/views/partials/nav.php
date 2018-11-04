<nav>
    <div class="container">
        <div class="row container">
            <div class="col col-sm-4">
                <a href="/"> <img style="width: 100%; height:100%;" src="imgs/GezinshuisRegterink_logo_breed.png"
                                  alt="logo"/></a>
            </div>
            <div class="col-sm-8">

                <div class="flexContainer">
                    <a class="navLink nav-link" href="<?= \Qui\lib\Routes::$routes['home'] ?>">Home</a>
                    <a class="navLink nav-link" href="<?= \Qui\lib\Routes::$routes['about'] ?>">About us</a>
                    <a class="navLink nav-link" href="<?= \Qui\lib\Routes::$routes['contact'] ?>">Contact</a>
                    <?php
                    $loggedIn = \Qui\lib\facades\Authentication::verify();
                    $user = \Qui\lib\facades\Authentication::verify(true);
                    // if NOT logged in
                    $login = \Qui\lib\Routes::$routes['login'];
                    $register = \Qui\lib\Routes::$routes['register'];
                    if (!$loggedIn) {
                        echo "<a class=\"navLink nav-link\" href=\"${login}\">Login</a>";
                        echo "<a class=\"navLink nav-link\" href=\"${register}\">Register</a>";
                    }
                    // if logged in
                    if ($loggedIn) {
                        $logout = \Qui\lib\Routes::$routes['logout'];
                        echo "<a class=\"navLink nav-link\" href=\"/{$logout}\">Logout</a>";
                        echo "<a class=\"navLink nav-link\" href='" . \Qui\lib\Routes::$routes['cms'] . "'>Go to CMS</a>";
                        echo "<a class=\"navLink nav-link\" href=\"#\">Hi, {$user['fname']}!</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>