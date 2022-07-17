<div class="front-main--register" style="background-image: url(<?= $final_url ?>./dist/bg-login.png)">
    <aside style="background-image: url(<?= $final_url ?>./dist/bg-login.png)">
        <div>
            <img src="../dist/logo-spiral-1.png" alt="register-logo">
            <h1>Sported</h1>
        </div>
        
    </aside>
    <section id="register-section">
        <h1>Créez votre compte</h1>
        <?php
            $this->includePartial("form", $configFormRegister);
        ?>
    </section>
</div>