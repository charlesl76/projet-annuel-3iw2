Création du formulaire
<form method="<?= $config["config"]["method"]??"POST" ?>" action="<?= $config["config"]["action"]??"" ?>">

    <?php foreach ($config["inputs"] as $name=>$input):?>

        <?php if($input["type"] == "select"):?>
        <select name="<?=$name?>" id="<?=$input["id"]?>">
            <?php if ($input['countries']): ?>
                <?php for($i = 0; $i < count($input["countries"]); $i++): ?>
                    <option value="<?= $input["countries"][$i]["id"]; ?>"><?= $input["countries"][$i]["name"]; ?></option>
                    <?php if($i === count($input["countries"])):?>
                        </select>
                    <?php endif;
                endfor; ?>
            <?php endif; ?>
            <?php if($input['roles']):?>
                <?php for($i=0; $i < count($input['roles']); $i++): ?>
                    <option value="<?= $input['roles'][$i]["id"]; ?>"><?= $input["roles"][$i]["name"]; ?> </option>
                    <?php if($i === count($input["roles"])): ?>
                        </select>
                    <?php endif;
                    endfor; ?>
            <?php endif ?>

            <?php else: ?>
                <input name="<?=$name?>"
                       id="<?=$input["id"]??""?>"
                       type="<?=$input["type"]??"text" ?>"
                       class="<?=$input["class"]??""?>"
                       placeholder="<?=$input["placeholder"]??""?>"
                       value="<?=$input["value"]??""?>"
                    <?= (!empty($input["required"]))?'required="required"':'' ?>
                >
                <br>
        <?php endif; endforeach;?>

    <input type="submit" value="<?= $config["config"]["submit"]??"Valider" ?>">
</form>
