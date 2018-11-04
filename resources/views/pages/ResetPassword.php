<div class="container" style="min-height: 100vh">
    <div>
        <div class="jumbotron">
            <h3 class="display-12 title">Reset your password</h3>
        </div>
        <form method="post" action="<?php echo \Qui\lib\Routes::$routes['resetPassword'] ?>" id="resetPassword">
            <?php
            \Qui\lib\Form::input('Wachtwoord', 'fa-lock',
                "<input type=\"password\" class=\"form-control ownInput\" id=\"password1\" placeholder=\"Enter your new password\"
                       name=\"password\" required minlength='5'>");

            \Qui\lib\Form::input('Wachtwoord herhalen', 'fa-lock',
                "<input type=\"password\" class=\"form-control ownInput\" id=\"password1\" placeholder=\"Repeat your new password\"
                       name=\"password2\" required minlength='5'>");
            ?>
            <input style="display:none;" value="<?php echo $_GET['forgotPasswordToken'] ?>" name="forgotPasswordToken"/>
            <button type="submit" class="house-btn">Submit</button>
        </form>
    </div>

    <script src="js/resetpassword.js"></script>
</div>