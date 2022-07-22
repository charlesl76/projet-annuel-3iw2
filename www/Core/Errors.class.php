<?php

namespace App\Core;


class Errors extends Decorator
{
    public function getError(): string
    {
        return "(" . parent::greeting() . ") Tout vas bien vous avez déjà intaller l'application";
    }
}
