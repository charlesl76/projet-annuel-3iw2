<div class="container-forget-password">
    <img src="<?= $final_url ?>./dist/lock_password.svg" alt="forgot-password">
    <h3 class="header-box">Trouble logging in?</h3>

    <form action="<?= $final_url ?>/forgot-password" method="post">
        <div class="form-group-fp">
            <label for="user">Enter your email or username and we'll send you a link to get back into your account.</label>
            <input type="text" class="form-control" id="user" name="user_cred" placeholder="Enter username or email">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>