<?php
    session_start();

    function loadEnv()
    {
        $envFile = __DIR__ . '/.env';
        if (file_exists($envFile))
        {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line)
            {
                if (strpos(trim($line), '#') === 0)
                {
                    continue;
                }
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);
                if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV))
                {
                    putenv("$name=$value");
                    $_ENV[$name] = $value;
                    $_SERVER[$name] = $value;
                }
            }
        }
    }

    loadEnv();

    DEFINE("HOST", $_ENV["HOST"]);
    DEFINE("USERNAME", $_ENV["USERNAME"]);
    DEFINE("PASSWORD", $_ENV["PASSWORD"]);
    DEFINE("DATABASE", $_ENV["DATABASE"]);
    DEFINE("PORT", $_ENV["PORT"]);

    DEFINE ("HEADER", "WoWEmu 5.4.8 Repack Bugtracker");
    DEFINE ("TITLE", "Bugtracker");
    DEFINE ("CAPTCHA", "10");

    DEFINE ("ACP_PASSWORD", "bugtracker");
    

    require ("classes/Database.php");
    require ("classes/Account.php");
    require ("classes/Admin.php");
    require ("classes/Bugs.php");
    require ("classes/Common.php");

    $Database = new Database();
    $Account = new Account();
    $Admin = new Admin();
    $Bugs = new Bugs();
    $Common = new Common();

?>