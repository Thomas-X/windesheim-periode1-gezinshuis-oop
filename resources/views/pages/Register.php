<div class="mainContainer" style="min-height: 100vh">
    <div>
        <form method="post" action="/register">
            <div class="form-group">
                <label for="fname">First name</label>
                <input type="text" class="form-control" id="fname" placeholder="Enter your firstname" name="fname">
            </div>
            <div class="form-group">
                <label for="lname">Last name</label>
                <input type="text" class="form-control" id="lname" placeholder="Enter your lastname" name="lname">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
            </div>
            <div class="form-group">
                <label for="lname">Mobile number</label>
                <input type="number" class="form-control" id="mobilenumber" placeholder="Enter your mobile number" name="mobile">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


<script src="js/register.js"></script>