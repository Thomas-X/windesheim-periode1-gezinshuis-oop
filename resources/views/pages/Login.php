<div class="mainContainer" style="min-height: 100vh">
    <div>
        <form method="post" action="/login">
            <div class="form-group">
                <label for="fname">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
                <a id="passwordHelpBlock" class="form-text text-muted" href="/forgotpassword">
                    Wachtwoord vergeten?
                </a>
            </div>
            <div class="form-group">
                <label for="lname">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <a href="/forgotpassword" />
    </div>
</div>


<script src="js/login.js"></script>