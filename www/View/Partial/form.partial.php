<form method="<?= $config["config"]["method"]??"POST" ?>" action="<?= $config["config"]["action"]??"" ?>" id="<?= $config["config"]["id"] ?>" class="<?= $config["config"]["class"] ?>"  >

    <?php foreach ($config["inputs"] as $name=>$input):?>

        <?php if($input["type"] == "select"):?>
        <select name="<?=$name?>" id="<?=$input["id"]?>">
            <?php for($i = 0; $i < count($input["countries"]); $i++): ?>
                <option value="<?= $input["countries"][$i]["id"]; ?>"><?= $input["countries"][$i]["name"]; ?></option>
                <?php if($i === count($input["countries"])):?>
                    </select>
                <?php endif;
            endfor;
        else: ?>
            <input name="<?=$name?>"
                   id="<?=$input["id"]?>"
                   type="<?=$input["type"]?>"
                   class="<?=$input["class"]?>"
                   placeholder="<?=$input["placeholder"]?>"
                <?= (!empty($input["required"]))?'required="required"':'' ?>
            >
            <br>
        <?php endif; endforeach;?>

    <input type="submit" value="<?= $config["config"]["submit"]??"Valider" ?>">
</form>