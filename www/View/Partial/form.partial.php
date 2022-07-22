<form method="<?= $config["config"]["method"]??"POST" ?>" action="<?= $config["config"]["action"]??"" ?>" id="<?= $config["config"]["id"]??"" ?>" class="<?= $config["config"]["class"]??"" ?>"  >
    <?php foreach ($config["inputs"] as $name => $input) : ?>

        <?php if ($input["type"] == "select" && (isset($input["countries"])
            || isset($input["roles"]) || isset($input["status"]))):
            if (isset($input["countries"])) :
                $inputOptions = $input["countries"];
            elseif (isset($input["roles"])) :
                $inputOptions = $input["roles"];
            elseif (isset($input["status"])) :
                $inputOptions = $input["status"];
            endif;
        ?>
            <select name="<?= $name ?>" id="<?= $input["id"] ?>">
                <?php foreach ($inputOptions as $inputOption): ?>
                    <option value="<?= $inputOption["id"]; ?>"><?= $inputOption["name"]; ?></option>
                <?php endforeach; ?>
            </select>
        <?php elseif ($input["type"] == "select" && isset($input["status"])) : ?>
            <select name="<?= $name ?>" id="<?= $input["id"] ?>">
                <?php foreach ($inputOptions as $inputOption): ?>
                    <option value="<?= $inputOption["id"]; ?>"><?= $inputOption["name"]; ?></option>
                <?php endforeach; ?>
            </select>

            <?php elseif ($input["type"] == "select" && isset($input["images"])) : ?>

<select name="<?= $name ?>" id="<?= $input["id"] ?>">

</select>

<style>
    form {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    form>input {
        height: 30px;
    }
</style>

<script>
    var ddData = [
        <?php foreach ($input["images"] as $image) : ?> {
                <?php
                    if (isset($input["selected"])) :
                        $dir = "../dist/assets/images/tags-icons/olympic-sports/" . $image["type"] . "/" . $image["name"] . "." . strtolower($image["type"]);
                        if ($image["id"] == $input["selected"]) : ?>
                        selected: true,
                        <?php else : ?>
                        selected: false,
                        <?php
                        endif;
                    else :
                        $dir = "dist/assets/images/tags-icons/olympic-sports/" . $image["type"] . "/" . $image["name"] . "." . strtolower($image["type"]);
                    endif;
                        ?>
                        value: '<?= $image["id"]; ?>',
                            imageSrc: '<?= $dir ?>',
            },
        <?php endforeach; ?>
    ];

    $('#thumbnail').ddslick({
        width: '100px',
        height: '200px',
        imagePosition: "left",
        data: ddData,
        selectText: "Image",
        onSelected: function(data) {
            data.selectedData.name = "content";
            $('#thumbnail').find('input[type=hidden]:first').attr("name", data.selectedData.name);
        }

    });
</script>

<?php

            elseif ($input["type"] == "select" && (isset($input["parent"]) || isset($input["post_parent"]))) :
            if (isset($input["parent"])) : ?>
            <div>
                <select name="<?= $name ?>" id="<?= $input["id"] ?>">
                    <?php foreach ($input['parent'] as $tag): ?>
                        <?php if(isset($tag['selected'])) : ?>
                            <option value="<?= $tag['id']; ?>" selected><?= $tag['name']; ?></option>
                        <?php else: ?>
                            <option value="<?= $tag["id"]; ?>"><?= $tag['name']; ?></option>
                        <?php endif;
                    endforeach; ?>
                </select>
            </div>


            <?php elseif (isset($input["post_parent"])) : ?>
            <div>
                <select name="<?= $name ?>" id="<?= $input["id"] ?>">
                    <?php foreach ($input['post_parent'] as $article): ?>
                        <?php if(isset($article['selected'])) : ?>
                            <option value="<?= $article['id']; ?>" selected><?= $article['title']; ?></option>
                        <?php else: ?>
                            <option value="<?= $article["id"]; ?>"><?= $article['title']; ?></option>
                        <?php endif;
                    endforeach; ?>
                </select>
            </div>
            <?php endif; ?>

            <?php elseif ($input["type"] == "textarea") : ?>
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


<?php if ($input["type"] == "select") : ?>
    <select name="<?= $name ?>" id="<?= $input["id"] ?>">
        <?php if ($input['countries']) : ?>
            <?php for ($i = 0; $i < count($input["countries"]); $i++) : ?>
                <option value="<?= $input["countries"][$i]["id"]; ?>"><?= $input["countries"][$i]["name"]; ?></option>
                <?php if ($i === count($input["countries"])) : ?>
    </select>
<?php endif;
                        endfor; ?>
<?php endif; ?>

<?php endif; ?>
<?php
            else : ?>
    <input name="<?= $name ?>" id="<?= $input["id"] ?>" type="<?= $input["type"] ?>" class="<?= $input["class"] ?>" <?= !empty($input["value"]) ? " value=\"" . $input["value"] . "\" " : " " ?> <?= (!empty($input["placeholder"]) ? 'placeholder="'.$input["placeholder"].'"' : ""); ?> <?= (!empty($input["hidden"])) ? 'hidden="hidden"' : '' ?>  <?= (!empty($input["disabled"])) ? 'disabled' : '' ?> <?= (!empty($input["required"])) ? 'required="required"' : '' ?>>
    <br>
<?php endif;
        endforeach; ?>

<input type="submit" value="<?= $config["config"]["submit"] ?? "Valider" ?>">

</form>