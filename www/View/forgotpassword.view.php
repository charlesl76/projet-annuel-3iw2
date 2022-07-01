<?php if (!isset($id)) : ?>
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
<?php elseif (isset($id) && $id == 1) : ?>

    <p>
        An email has been sent to your email address with a link to reset your password.
    </p>

<?php elseif (isset($id) && $id == 0) : ?>
    <p>
        Your account does not exist, is not activated or is blocked. <a href="mailto:admin@sported.site">Please contact the administrator</a>.
    </p>
<?php endif; ?>