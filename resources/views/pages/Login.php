<div class="mainContainer" style="min-height: 100vh">
    <div>
        <form method="post" action="/login">
            <div class="form-group">
                <h3 class="title" for="fname">E-mail</h3>
                <div class="form-group ">
                    <div class="input-group mb-5">
                        <div class="input-group-prepend">
                            <div class="input-group-text icon-form"><i class="fas fa-envelope"></i></div>
                        </div>
                        <input type="email" name="email" class="form-control ownInput" id="email" placeholder="Enter your email">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <h3 class="title" for="fname">Wachtwoord</h3>
                <div class="input-group mb-5">
                    <div class="input-group-prepend">
                        <div class="input-group-text icon-form"><i class="fas fa-lock"></i></div>
                    </div>
                        <input type="password" name="password" class="form-control ownInput" id="password" placeholder="Enter your password">
                </div>
                <a id="passwordHelpBlock" class="form-text text-muted" href="/forgotpassword">
                    Wachtwoord vergeten?
                </a>
            </div>

            <button type="submit" class="btn btn-primary house-btn">Submit</button>
        </form>
        <a href="/forgotpassword" />
    </div>
</div>


<script src="js/login.js"></script>