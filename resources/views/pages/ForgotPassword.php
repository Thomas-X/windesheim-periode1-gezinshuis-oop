<div class="mainContainer" style="min-height: 100vh">
    <div>
        <?php
        if ($_GET['success'] == true)
            echo "<h3>Check je inbox!</h3>";
        ?>
        <form method="post" action="/forgotpassword">
            <div class="form-group">
                <h3 class="title" for="fname">Voer je e-mail in</h3>
                <div class="input-group mb-5">
                    <div class="input-group-prepend">
                        <div class="input-group-text icon-form"><i class="fas fa-envelope"></i></div>
                    </div>
                    <input type="email" name="email" class="form-control ownInput" id="email" placeholder="Enter your email">
                </div>
            </div>
            <button type="submit" class="house-btn">Submit</button>
        </form>
    </div>
</div>