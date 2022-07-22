<?php

namespace App\Core;

interface Component
{
    public function greeting(): string;
}

class GreetingInstall implements Component
{
   public function greeting() : string
   {
     return "Bienvenue dans votre Installeur (Votre installaeur est installer avec succes)";
   }   

}
