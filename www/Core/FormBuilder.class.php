<?php

namespace App\Core;

class FormBuilder
{

    public static function render(array $config): string
    {
        $html = "<form 
				method='" . ($config["config"]["method"] ?? "POST") . "' 
				id='" . ($config["config"]["id"] ?? "") . "' 
				class='" . ($config["config"]["class"] ?? "") . "'
				enctype='" . ($config["config"]["enctype"] ?? "") . "'
				action='" . ($config["config"]["action"] ?? "") . "'>";

        foreach ($config["inputs"] as $name=>$input){
                $input["type"] === "checkbox" ?   $html .= self::renderCheckbox($name,$input) : "";
                $input["type"] === "radio" ?   $html .= self::renderRadio($name,$input) : "";
                $input["type"] === "textarea" ?   $html .= self::renderTextarea($name,$input) : "";
                $input["type"] === "select" ?   $html .= self::renderSelect($name,$input) : "";
                $input["type"] === "file" || $input["type"] === "text" || $input["type"] === "password"|| $input["type"] === "email" ?   $html .= self::renderInput($name,$input) : "";
                $input["type"] === "hidden" ?  $html .= self::renderHidden($name,$input) : "";
        }

        $html .= " <input type='submit' value='".($config["config"]["submit"] ?? '')."'>";
        $html .= "</form>";
         return $html;
    }

    private static function renderInput(string $name, array $input): string
    {
        $data = "<label for='".($name ?? "")."'>".ucfirst($name)."</label>";
        $data .= " <input value='".($input["value"] ?? '')."'  type='".($input["type"] ?? 'text')."'  class='".($input["class"] ?? '')."'  id='".($input["id"] ?? '')."' placeholder='".($input["placeholder"] ?? '')."' ".($input["disabled"] ?? "")." name='".($name ?? "")."'./>";
        return $data;
    }



}