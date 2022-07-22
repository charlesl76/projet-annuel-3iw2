<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["complete_installation"]) && $_SESSION["complete_installation"] == true) {

    $step = 7;
    include_once("./View/install.view.php");
}

if ((!isset($db_name) ||
        !isset($db_user) ||
        !isset($db_pwd) ||
        !isset($db_driver) ||
        !isset($db_port) ||
        !isset($db_host) ||
        !isset($db_prefix)) &&
    !isset($_GET['first_time']) &&
    !isset($_GET['db_init']) &&
    !isset($_POST['db_init']) &&
    !isset($_POST['db_host']) &&
    !isset($_POST['db_port']) &&
    !isset($_POST['db_driver']) &&
    !isset($_POST['db_user']) &&
    !isset($_POST['db_password']) &&
    !isset($_POST['db_prefix']) &&
    !isset($_POST['site_name']) &&
    !isset($_SESSION["complete_installation"])
) {
    header("location: activate.php?first_time=true");
} elseif (isset($_GET['first_time']) && $_GET['first_time'] == "true" && !empty(strstr($_SERVER["REQUEST_URI"], "first_time=true"))) {

    $step = 0;
    include_once("./View/install.view.php");
} elseif (isset($_GET['db_init'])  && !empty(strstr($_SERVER["REQUEST_URI"], "db_init"))) {

    $step = 1;
    include_once("./View/install.view.php");
} elseif (!empty($_POST["db_name"])) {

    // get database name
    $db_name = $_POST["db_name"];

    if ($_POST["db_init"] == true) {
        if (checkDatabaseName($db_name) == true) {
            $_SESSION['db_name'] = $db_name;
            $step = 2;
            include_once("./View/install.view.php");
        } else {
            $error['db_name'] = "The database name is incorrect, only alphanumeric characters, dashes and underscores are allowed.";
            $step = 1;
            include_once("./View/install.view.php");
        }
    }

    include_once("./View/install.view.php");
} elseif (!empty($_POST["db_host"])  && !empty($_POST["db_port"])) {

    // get host and port
    $db_host = $_POST["db_host"];
    $db_port = intval($_POST["db_port"]);

    if (checkHost($db_host, $db_port) == true) {
        $_SESSION['db_host'] = $db_host;
        $_SESSION['db_port'] = $db_port;
        $step = 3;
        include_once("./View/install.view.php");
    } else {
        $error['db_name'] = "There is a problem with the host or the port, please check again.";
        $step = 2;
    }

    include_once("./View/install.view.php");
} elseif (!empty($_POST["db_driver"])) {

    // get driver
    $db_driver = $_POST["db_driver"];
    $_SESSION['db_driver'] = $db_driver;

    $step = 4;
    include_once("./View/install.view.php");
} elseif (!empty($_POST["db_user"]) && !empty($_POST["db_password"])) {

    // get username and password
    $db_user = $_POST["db_user"];
    $db_password = $_POST["db_password"];
    $_SESSION['db_user'] = $db_user;
    $_SESSION['db_password'] = $db_password;

    $step = 5;
    include_once("./View/install.view.php");
} elseif (!isset($_SESSION["db_prefix"])) {
    if (!empty($_POST["db_prefix"]) || $_POST["db_prefix"] == "") {
        // get prefix
        $db_prefix = $_POST["db_prefix"];
        $db_prefix = checkPrefix($db_prefix);
        if ($db_prefix == false) {
            $error['db_prefix'] = "No special characters and numbers are allowed, only letters.";
            $step = 5;
        } else {
            $_SESSION['db_prefix'] = $db_prefix;
            $step = 6;
            include_once("./View/install.view.php");
        }
    }
} else {
    http_response_code(404);
}


function checkDatabaseName(string $db_name): bool
{

    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬éèç€êùâîôñã]/', $db_name)) {
        return false;
    } else {
        return true;
    }
}

function checkHost(string $db_host, int $db_port): bool
{

    if (filter_var($db_host, FILTER_VALIDATE_IP) == true || $db_host == "database") {
        if ($db_port <= 0 || $db_port > 65535) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function checkPrefix($db_prefix)
{

    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬éèç€êùâîôñã]/', $db_prefix)) {
        return false;
    } else {
        if ($db_prefix == "") {
            $chars = "abcdefghijklmnopqrstuvwxyz";
            $var_size = strlen($chars);
            $random_str = "";
            for ($x = 0; $x < 4; $x++) {
                $random_str .= $chars[rand(0, $var_size - 1)];
            }
            return $random_str;
        } else {
            return $db_prefix;
        }
    }
}
