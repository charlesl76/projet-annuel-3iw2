<div class="container flex jc-center">
        <div class="flex ai-center jc-center column form-register">
            <h1>Se connecter</h1>

            <?php if (isset($form)) : ?>
                <?php echo $form ?>

            <?php endif; ?>
</div>


<br />
<div class="row">
    <a href="/forgetPassword" id="mdp_oubli" class="tres-petit texte souligne-jaune">Mot de passe oubliée ?</a>
</div>
<div class="row">
    <a href="/register" class="tres-petit texte souligne-bleu italic">Créer un compte</a>
</div>
<br />

        
    </div>
