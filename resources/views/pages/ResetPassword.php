<div class="mainContainer" style="min-height: 100vh">
    <div>
        <div class="jumbotron">
            <h3 class="display-12 title">Reset your password</h3>
        </div>
        <form method="post" action="/resetpassword">
            <div class="form-group">
                <div class="input-group mb-5">
                    <div class="input-group-prepend">
                <div class="input-group-text icon-form"><i class="fas fa-lock"></i></div>
                    </div>
                <h2 class="title" for="pwd1">Password</h2>
                <input type="password" class="form-control" id="password1" placeholder="Enter your new password"
                       name="password">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-5">
                    <div class="input-group-prepend">
                 <div class="input-group-text icon-form"><i class="fas fa-lock"></i></div>
                    </div>
                <h2 class="title" for="pwd2">Confirm password</h2>
                <input type="password" class="form-control" id="password2" placeholder="Confirm your new password"
                       name="password_">
                </div>
            </div>

            <input style="display:none;" value="<?php echo $_GET['forgotPasswordToken'] ?>" name="forgotPasswordToken"/>
            <button type="submit" class="house-btn">Submit</button>
        </form>
    </div>
</div>