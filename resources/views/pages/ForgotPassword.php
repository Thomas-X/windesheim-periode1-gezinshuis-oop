<div class="mainContainer" style="min-height: 100vh">
    <div>
        <?php
        if ($_GET['success'] == true)
            echo "<h3>Check je inbox!</h3>";
        ?>
        <form method="post" action="/forgotpassword">
            <div class="form-group">
                <label for="email">Voer je email in</label>
                <input type="text" class="form-control" id="email" placeholder="Enter your email"
                       name="email">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>