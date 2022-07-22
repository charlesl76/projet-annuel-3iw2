<?php

namespace App\Controller;

use App\Core\View;
use App\Core\GreetingInstall;
use App\Core\Errors;
use App\Model\User as UserModel;
use App\Model\Session as UserSession;

class General{

    public function message(GreetingInstall $component): string
    {
    return $component->greeting();
    }

    public function home()
    {
        echo "Welcome";
        $simple = new GreetingInstall();
        $msgHome = $this->message($simple);
        $msgError = new Errors($simple);

        $user = new UserModel();
        $session = new UserSession();

        $filename ='conf.inc.php';

        if (file_exists($filename)) {
            $session->addFlashMessage("success", $msgHome);

        } else {
            $session->addFlashMessage("success", $msgError);

        }
    }

    public function contact()
    {
        $view = new View("contact");
    }

    public function install()
    {
        $user = new UserModel();

        $filename = 'conf.inc.php';
        if (file_exists($filename)) {
            echo "Vous avez déjà installer votre Installeur ";
        } else {
            if (!empty($_GET)) {
                $file = fopen("conf.inc.php", "w");
                fwrite($file, "\n");

                $txt = "<?php";
                fwrite($file, $txt);
                fwrite($file, "\n");

                $txt = 'define("DBNAME","' . $_GET["CAPTCHA_SECRET_KEY"] . '");';
                fwrite($file, $txt);
                fwrite($file, "\n");

                $txt = 'define("DBUSER","' . $_GET["DBUSER"] . '");';
                fwrite($file, $txt);
                fwrite($file, "\n");
                $txt = 'define("DBPWD","' . $_GET["DBPWD"] . '");';
                fwrite($file, $txt);
                fwrite($file, "\n");
                $txt = 'define("DBDRIVER","' . $_GET["DBDRIVER"] . '");';
                fwrite($file, $txt);
                fwrite($file, "\n");
                $txt = 'define("DBPORT","' . $_GET["DBPORT"] . '");';
                fwrite($file, $txt);
                fwrite($file, "\n");
                $txt = 'define("DBHOST","' . $_GET["DBHOST"] . '");';
                fwrite($file, $txt);
                fwrite($file, "\n");
                $txt = 'define("DBPREFIXE","' . $_GET["DBPREFIXE"] . '");';
                fwrite($file, $txt);
                fwrite($file, "\n");

                $file = fopen("conf.inc.php", "w");
                $txt = "fichier temoins pour certifier de l'installation";
                fwrite($file, $txt);

                echo("<br>");
                echo("********************************");
                echo("<br>");

                echo("Bravo L'instalation Réussite");
                $user->init();
            }
        }
    }

}


