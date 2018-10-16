<div class="mainContainer" style="min-height: 100vh">
    <div>
        <form method="post" action="<?php echo \Qui\lib\Routes::routes['forgotPassword'] ?>">

            <?php
            \Qui\lib\Form::input('E-mail', 'fa-envelope',
                "<input type=\"email\" name=\"email\" class=\"form-control ownInput\" id=\"email\"
                               placeholder=\"Enter your email\" required minlength=\"2\"/>");
            ?>

            <button type="submit" class="house-btn">Submit</button>
        </form>
    </div>
</div>