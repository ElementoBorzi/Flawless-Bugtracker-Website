<?php

/**
 * This class is used for Application related functions
 *
 * @name	: Application.php
 * @package	: Bugtracker
 * @author	: Gabriel Ferreira <ferreirawow@gmail.com>
 * @link	: --
 * @version	: 1.0
 */
class Application {

    public function loadEnv()
    {
        $envFile = "engine/.env";

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

    public function AppInit()
    {
        $this->loadEnv();

        DEFINE("HOST", $_ENV["HOST"]);
        DEFINE("USERNAME", $_ENV["USERNAME"]);
        DEFINE("PASSWORD", $_ENV["PASSWORD"]);
        DEFINE("DATABASE", $_ENV["DATABASE"]);
        DEFINE("PORT", $_ENV["PORT"]);
        
        #Admin Control Panel Password
        DEFINE ("ACP_PASSWORD", $_ENV["ACP_PASSWORD"]);
    }
}