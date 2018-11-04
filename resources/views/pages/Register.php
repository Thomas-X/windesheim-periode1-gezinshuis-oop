<div class="container" style="min-height: 100vh">
    <div>
        <form method="post" action="<?php echo \Qui\lib\Routes::$routes['onRegister'] ?>" id="registerForm">
            <?php
            \Qui\lib\Form::input('Voornaam', 'fa-user',
                "<input type=\"text\" class=\"form-control ownInput\" id=\"fname\" placeholder=\"Enter your firstname\" name=\"fname\" required>");

            \Qui\lib\Form::input('Achternaam', 'fa-user',
                "<input type=\"text\" class=\"form-control ownInput\" id=\"lname\" placeholder=\"Enter your lastname\" name=\"lname\" required>");

            \Qui\lib\Form::input('E-mail', 'fa-envelope',
                "<input type=\"email\" class=\"form-control ownInput\" id=\"email\" placeholder=\"Enter your e-mail\"
                           name=\"email\" required>");

            \Qui\lib\Form::input('Mobiel nummer', 'fa-phone',
                "<input type=\"number\" class=\"form-control ownInput\" id=\"mobilenumber\"
                           placeholder=\"Enter your mobile number\" name=\"mobile\" required>");

            \Qui\lib\Form::input('Wachtwoord', 'fa-lock',
                "<input type=\"password\" class=\"form-control ownInput\" id=\"password\" placeholder=\"Enter your password\"
                           name=\"password\" minlength='5' required>");
            ?>
            <button type="submit" class="btn btn-primary house-btn">Submit</button>
        </form>
    </div>
</div>


<script src="js/register.js"></script>