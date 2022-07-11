<?php

namespace App\Core;
use App\Core\BaseSQL;

class  Helper
{


  public static function cleanMail($mail) {
		return mb_strtolower(trim($mail));
	}
    

  public static function createToken() : string{
    $bytes = random_bytes(128);
    return substr(str_shuffle(bin2hex($bytes)), 0, 255);
	}

}