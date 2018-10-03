<div class="mainContainer" style="min-height: 100vh">
    <div>
        <div class="jumbotron">
            <h1 class="display-12">Reset your password</h1>
        </div>
        <form method="post" action="/resetpassword">
            <div class="form-group">
                <label for="pwd1">Password</label>
                <input type="password" class="form-control" id="password1" placeholder="Enter your new password"
                       name="password">
            </div>
            <div class="form-group">
                <label for="pwd2">Confirm password</label>
                <input type="password" class="form-control" id="password2" placeholder="Confirm your new password"
                       name="password_">
            </div>

            <input style="display:none;" value="<?php echo $_GET['forgotPasswordToken'] ?>" name="forgotPasswordToken"/>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>