<div class="front-main" style="background-image: url(<?= $final_url ?>./dist/bg-login.png)">
    <section class="login-main-card">
        <div class="half-card login">
            <img src="<?= $final_url ?>./dist/logo-sported-vertical.svg" alt="Logo">

            <?php if (isset($form)) : ?>
                <?php echo $form ?>
            <?php endif; ?>

            <div class="form-nav-account">
                <a href="/forgetPassword" class="form-nav-account-link">Forget password?</a>
                <a href="/register" class="form-nav-account-link">Sign Up</a>
            </div>
        </div>
        
        <div class="half-card ad">
            <img src="<?= $final_url ?>./dist/login-ad.png">
        </div>

    </section>
</div>