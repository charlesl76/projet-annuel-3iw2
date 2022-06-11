<form method="<?= $config["config"]["method"] ?? "POST" ?>" action="<?= $config["config"]["action"] ?? "" ?>">

    <?php foreach ($config["inputs"] as $name => $input) : ?>

        <?php if ($input["type"] == "select" && isset($input["countries"])) : ?>
            <select name="<?= $name ?>" id="<?= $input["id"] ?>">
                <?php for ($i = 0; $i < count($input["countries"]); $i++) : ?>
                    <option value="<?= $input["countries"][$i]["id"]; ?>"><?= $input["countries"][$i]["name"]; ?></option>
                    <?php if ($i === count($input["countries"])) : ?>
            </select>
    <?php endif;
                endfor;
            elseif ($input["type"] == "select" && isset($input["status"])) : ?>
    <select name="<?= $name ?>" id="<?= $input["id"] ?>">
        <?php for ($i = -1; $i + 1 < count($input["status"]); $i++) : ?>
            <option value="<?= $input["status"][$i]["id"]; ?>"><?= $input["status"][$i]["name"]; ?></option>
            <?php if ($i === count($input["status"])) : ?>
    </select>
<?php endif;
                endfor;
            elseif ($input["type"] == "textarea") : ?>
<textarea name="<?= $name ?>" id="<?= $input["id"] ?>" class="<?= $input["class"] ?? "" ?>"></textarea>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        <?php
                if ($input["type"] == "textarea") :
                    if (strpos($config["config"]["action"], 'update') !== false) :
    ?>
        setup: function(editor) {
            editor.on('init', function(e) {
                let content = `<?= utf8_encode($input["value"]) ?>`;
                editor.setContent(content);
            });
        },
        <?php endif;
                endif;
    ?>
    });

    

</script>
<?php
            else : ?>
    <input name="<?= $name ?>" id="<?= $input["id"] ?>" type="<?= $input["type"] ?>" class="<?= $input["class"] ?>" <?= !empty($input["value"]) ? " value=\"" . $input["value"] . "\" " : " " ?> placeholder="<?= $input["placeholder"] ?>" <?= (!empty($input["hidden"])) ? 'hidden="hidden"' : '' ?> <?= (!empty($input["required"])) ? 'required="required"' : '' ?>>
    <br>
<?php endif;
        endforeach; ?>

<input type="submit" value="<?= $config["config"]["submit"] ?? "Valider" ?>">
</form>