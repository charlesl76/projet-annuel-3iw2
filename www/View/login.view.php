<div class="container flex jc-center">
        <div class="flex ai-center jc-center column form-register">
            <h1>Se connecter</h1>

            <?php
            $this->includePartial("form", $getFormLogin);
            ?>
        </div>


<br />
<div class="row">
    <a href="/forgot-password" id="mdp_oubli" class="tres-petit texte souligne-jaune">Mot de passe oubliée ?</a>
</div>
<div class="row">
    <a href="/register" class="tres-petit texte souligne-bleu italic">Créer un compte</a>
</div>
<br />

        
    </div>

