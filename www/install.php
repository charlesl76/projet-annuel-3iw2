<?php

session_start();

if (isset($_POST["email"])) {
    var_dump($_POST);
    $user["email"] = $_POST["email"];
    $user["password"] = $_POST["password"];
    registerSuperAdmin($user);
    addCompleteRegistration();
    header("location: /");

} else {
    // get prefix
    $site_name = $_POST["site_name"];

    $database = [
        "db_name"   => $_SESSION['db_name'],
        "db_user"   => $_SESSION['db_user'],
        "db_pwd"    => $_SESSION['db_password'],
        "db_driver" => $_SESSION['db_driver'],
        "db_port"   => $_SESSION['db_port'],
        "db_host"   => $_SESSION['db_host'],
        "db_prefix" => $_SESSION['db_prefix'],
    ];

    if (registerDatabase($database) == true) {
        if (registerConf($database, $site_name) == true) {
            $_SESSION["complete_installation"] = true;
            header('location: /');
        }
    }
}

function registerSuperAdmin(array $user)
{
    if (isset($user["email"])) {
        if (!isset($_SESSION["username"])) {
            $email = $user["email"];
            $pwd = hash('sha512', $user["password"]);
            $username = "admin";
            $first_name = "Super";
            $last_name = "Admin";
            $role = "admin";
            $datetime = new \DateTime();
            $registered_at = $datetime->format('Y-m-d H:i:s');
            $token = bin2hex(openssl_random_pseudo_bytes(32));

            try {
                // Connection to DB
                require "conf.inc.php";

                $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PWD);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                $db_table = DB_PREFIXE . '_user';
                // Database creation
                $sql = "INSERT INTO $db_table (email, password, username, first_name, last_name, role, registered_at, token) 
                    VALUES ('$email', '$pwd', '$username', '$first_name', '$last_name', '$role', '$registered_at', '$token');";

                $queryPrepared = $pdo->prepare($sql);
                $queryPrepared->execute();

                return "Super admin created";
            } catch (\PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            header('location: index.php');
        }
    }
}

function registerDatabase(array $database)
{

    try {
        // Connection to DB
        $pdo = new PDO($database["db_driver"] . ":host=" . $database["db_host"] . ";port=" . $database["db_port"], $database["db_user"], $database["db_pwd"]);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $db_name = $database["db_name"];
        $db_table = $database["db_prefix"] . '_comment';
        // Database creation
        $sql = "CREATE DATABASE $db_name;";

        // Comments table
        $sql .= "CREATE TABLE $db_name.$db_table (
            `id` int(11) NOT NULL,
            `post` int(11) NOT NULL,
            `author` int(11) NOT NULL,
            `published_date` datetime NOT NULL,
            `content` text NOT NULL,
            `status` int(11) NOT NULL DEFAULT '0',
            `approved_by` int(11) DEFAULT NULL,
            `comment_parent` int(11) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

        // Icons table
        $db_table = $database["db_prefix"] . '_icon';
        $sql .= "CREATE TABLE $db_name.$db_table (
            `id` int(11) NOT NULL COMMENT 'Icon ID',
            `collection` varchar(50) NOT NULL COMMENT 'Collection name as referenced on subfolder icon',
            `name` varchar(50) NOT NULL COMMENT 'Name as referenced in folder',
            `type` enum('PNG','SVG') NOT NULL COMMENT 'Image type, are allowed SVG PNG only'
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
          
          INSERT INTO $db_name.$db_table (`id`, `collection`, `name`, `type`) VALUES
          (1, 'olympic-sports', 'archery', 'SVG'),
          (2, 'olympic-sports', 'artistic_gymnastics', 'SVG'),
          (3, 'olympic-sports', 'athletics', 'SVG'),
          (4, 'olympic-sports', 'badminton', 'SVG'),
          (5, 'olympic-sports', 'basketball', 'SVG'),
          (6, 'olympic-sports', 'beach_volleyball', 'SVG'),
          (7, 'olympic-sports', 'boxing', 'SVG'),
          (8, 'olympic-sports', 'canoe_slalom', 'SVG'),
          (9, 'olympic-sports', 'canoe_sprint', 'SVG'),
          (10, 'olympic-sports', 'cycling_bmx', 'SVG'),
          (11, 'olympic-sports', 'cycling_mountain_bike', 'SVG'),
          (12, 'olympic-sports', 'cycling_road', 'SVG'),
          (13, 'olympic-sports', 'cycling_track', 'SVG'),
          (14, 'olympic-sports', 'diving', 'SVG'),
          (15, 'olympic-sports', 'equestrian', 'SVG'),
          (16, 'olympic-sports', 'fencing', 'SVG'),
          (17, 'olympic-sports', 'football', 'SVG'),
          (18, 'olympic-sports', 'golf', 'SVG'),
          (19, 'olympic-sports', 'handball', 'SVG'),
          (20, 'olympic-sports', 'hockey', 'SVG'),
          (21, 'olympic-sports', 'judo', 'SVG'),
          (22, 'olympic-sports', 'marathon_swimming', 'SVG'),
          (23, 'olympic-sports', 'modern_pentathlon', 'SVG'),
          (24, 'olympic-sports', 'olympic_medal_bronze', 'SVG'),
          (25, 'olympic-sports', 'olympic_medal_gold', 'SVG'),
          (26, 'olympic-sports', 'olympic_medal_silver', 'SVG'),
          (27, 'olympic-sports', 'olympic_torch', 'SVG'),
          (28, 'olympic-sports', 'rhythmic_gymnastics', 'SVG'),
          (29, 'olympic-sports', 'rowing', 'SVG'),
          (30, 'olympic-sports', 'rugby_sevens', 'SVG'),
          (31, 'olympic-sports', 'sailing', 'SVG'),
          (32, 'olympic-sports', 'shooting', 'SVG'),
          (33, 'olympic-sports', 'swimming', 'SVG'),
          (34, 'olympic-sports', 'synchronised_swimming', 'SVG'),
          (35, 'olympic-sports', 'table_tennis', 'SVG'),
          (36, 'olympic-sports', 'taekwondo', 'SVG'),
          (37, 'olympic-sports', 'tennis', 'SVG'),
          (38, 'olympic-sports', 'trampoline_gymnastics', 'SVG'),
          (39, 'olympic-sports', 'triathlon', 'SVG'),
          (40, 'olympic-sports', 'trophy', 'SVG'),
          (41, 'olympic-sports', 'volleyball', 'SVG'),
          (42, 'olympic-sports', 'water_polo', 'SVG'),
          (43, 'olympic-sports', 'weightlifting', 'SVG'),
          (44, 'olympic-sports', 'wrestling', 'SVG');";

        $db_table = $database["db_prefix"] . '_post';
        $sql .= "CREATE TABLE $db_name.$db_table (
            `id` int(11) NOT NULL,
            `author` int(11) NOT NULL,
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `date_gmt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `content` longtext NOT NULL,
            `title` tinytext NOT NULL,
            `excerpt` tinytext,
            `status` tinyint(4) NOT NULL,
            `post_modified` timestamp NULL DEFAULT NULL,
            `post_modified_gmt` timestamp NULL DEFAULT NULL,
            `post_parent` tinyint(4) DEFAULT NULL,
            `post_type` enum('category','article','page') NOT NULL,
            `comment_count` mediumint(9) DEFAULT '0'
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

        $db_table = $database["db_prefix"] . '_session';
        $sql .= "CREATE TABLE $db_name.$db_table (
            `id` int(10) NOT NULL,
            `token` varchar(255) NOT NULL,
            `user_id` int(11) DEFAULT NULL,
            `expiration_date` datetime NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

        $db_table = $database["db_prefix"] . '_user';
        $sql .= "CREATE TABLE $db_name.$db_table (
            `id` int(10) UNSIGNED NOT NULL,
            `username` varchar(50) CHARACTER SET latin1 NOT NULL,
            `password` varchar(255) CHARACTER SET latin1 NOT NULL,
            `first_name` varchar(45) CHARACTER SET latin1 NOT NULL,
            `last_name` varchar(60) CHARACTER SET latin1 NOT NULL,
            `email` varchar(254) CHARACTER SET latin1 NOT NULL,
            `role` enum('user','editor','admin') CHARACTER SET latin1 NOT NULL DEFAULT 'user',
            `registered_at` datetime NOT NULL,
            `updated_at` datetime DEFAULT NULL,
            `activated` tinyint(4) DEFAULT '0',
            `gender` enum('male','female') CHARACTER SET latin1 DEFAULT NULL,
            `blocked` tinyint(4) DEFAULT '0',
            `blocked_until` datetime DEFAULT NULL,
            `birth` date DEFAULT NULL,
            `token` varchar(255) COLLATE utf8_bin NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";



        $sql .= "ALTER TABLE $db_name.$db_table
        ADD PRIMARY KEY (`id`),
        ADD UNIQUE KEY `id_UNIQUE` (`id`),
        ADD UNIQUE KEY `username_UNIQUE` (`username`),
        ADD UNIQUE KEY `email_UNIQUE` (`email`);";

        $sql .= "ALTER TABLE $db_name.$db_table
        MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
        COMMIT;";

        $queryPrepared = $pdo->prepare($sql);
        $queryPrepared->execute();
        return true;
    } catch (\Exception $e) {
        die("SQL Error" . $e->getMessage());
    }
}

function registerConf(array $database, string $site_name): bool
{
    // Open file conf.inc.php and write the database configuration
    $file = fopen("conf.inc.php", "w");
    if ($file) {
        $content = "<?php\n\n";
        $content .= "// Database configuration, do not alter these values or your site may not function properly !\n";
        $content .= "define('DB_NAME', '" . $database["db_name"] . "');\n";
        $content .= "define('DB_USER', '" . $database["db_user"] . "');\n";
        $content .= "define('DB_PWD', '" . $database["db_pwd"] . "');\n";
        $content .= "define('DB_DRIVER', '" . $database["db_driver"] . "');\n";
        $content .= "define('DB_PORT', '" . $database["db_port"] . "');\n";
        $content .= "define('DB_HOST', '" . $database["db_host"] . "');\n";
        $content .= "define('DB_PREFIXE', '" . $database["db_prefix"] . "');\n";
        // 
        $content .= "define('SITE_NAME', '" . $site_name . "');\n";

        fwrite($file, $content);
        fclose($file);
        return true;
    } else {
        return false;
    }
}

function addCompleteRegistration()
{
    $file = fopen("conf.inc.php", "a");
    if ($file) {
        $content = "define('INSTALL', 'complete');\n";
        fwrite($file, $content);
        fclose($file);
        return true;
    } else {
        return false;
    }
}
