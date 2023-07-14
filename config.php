<?php
session_start();

//Error handling
unset($_SESSION["message"]);
$_SESSION["message"] = null;

// App main paths
define("BASE_PATH", realpath(__DIR__));
define("APP_PATH", empty($app_name) ? BASE_PATH ."/website" : BASE_PATH ."/". $app_name);
define("APP_TPL_PATH", empty($app_name) ? "website" : "../". $app_name);
define("CORE_PATH", BASE_PATH ."/engine");
define("MODEL_PATH", CORE_PATH ."/models");
define("ERROR_PATH", CORE_PATH ."/errors");
define("CONTROLLER_PATH", APP_PATH ."/controllers");
define("INCLUDE_PATH", APP_PATH ."/includes");
define("VIEW_PATH", APP_PATH ."/views");
define("SCRIPT_PATH", APP_TPL_PATH ."/scripts");

// App Constants
define("APP_NAME", "Flawless");
define ("APP_SLOGAN", "Report bugs with ease.");

// Models init
foreach (glob(MODEL_PATH."/*.php") as $filename)
{
    spl_autoload_register(
        function($filename)
        {
            include (MODEL_PATH."/".$filename.".php");
        }
    );
}
?>