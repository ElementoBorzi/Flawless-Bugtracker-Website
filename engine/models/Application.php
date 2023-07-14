<?php
/**
 * This class is used for Admin related functions
 *
 * @name	: Application.php
 * @package	: Flawless
 * @author	: Gabriel Ferreira <ferreirawow@gmail.com>
 * @link	: --
 * @version	: 1.0
 */
class Application {


    public static $error = "";

    /**
	 * Initiates the Application
	*/
    public static function AppInit()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        self::loadView($page);
    }

    /**
	 * Loads the Controller
	 * 
     * @param	: $page (string)
	 * @return	: Include controller page
     * @return	: $error (string)
	*/
    public static function loadController($page)
    {
        if (!empty($page))
        {
			if (file_exists(CONTROLLER_PATH ."/". $page .".php"))
            {
				require CONTROLLER_PATH ."/". $page .".php";
			} 
            else
            {
				self::$error = "Controller name doesn't exist in controller directory ".CONTROLLER_PATH;
                self::error("system");
			}
		}
        else
        {
            self::$error = "Function loadController() can't be empty.";
            self::error("system");
		}
    }

    /**
	 * Loads the View
	 * 
     * @param	: $page (string)
	 * @return	: Include view page
     * @return	: $error (string)
	*/
    public static function loadView($view)
    {
        if (!empty($view))
        {
            if (file_exists(VIEW_PATH."/".$view.".php"))
            {
                require (VIEW_PATH."/".$view.".php");
            }
            else
            {
                self::error("404");
            }     
        }
        else
        {
            include (VIEW_PATH."/home.php");
        }
    }

    /**
	 * Assigns a variable to another
	 * 
     * @param	: $var1 (string)
     * @param	: $var2 (string)
     * @return	: define
	*/
    public static function assign($var1, $var2)
    {
        define($var1, $var2);
    }

    /**
	 * Displays errors and redirects them to specific pages
	 * 
     * @param	: $error (string)
     * @return	: Error Page
	*/
    public static function error($error)
    {
		if (file_exists(ERROR_PATH ."/". $error .".php"))
        {
			ob_clean();
			require ERROR_PATH ."/". $error .".php";
			die();
		}
	}

    /**
	 * Installs the application
	 * 
     * @param	: $host (string)
     * @param	: $username (string)
     * @param	: $password (string)
     * @param	: $database (string)
     * @param	: $title (string)
     * @param	: $header (string)
     * @param	: $acpPassword (string)
     * @return	: TRUE or FALSE
	*/
    public static function install($host, $username, $password, $database, $title, $header, $acpPassword)
    {
		// Open db_config.php file
        $myfile = fopen ("../config.php", "w") or die("Unable to open file!");
    
		// Text to insert on the file
        $txt = '<?php

        /**
         * App Settings
         * DO NOT TOUCH UNTIL "User Settings"
         */
        
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
        
        /**
         * User Settings
         * YOU CAN EDIT FROM HERE BELLOW.
         */
        
        #Admin Control Panel Password
        define("ACP_PASSWORD", "'.$acpPassword.'");	
         
        #Website Information
        define("HEADER", "'.$header.'");
        define("TITLE", "'.$title.'");
        
        #Number of letters on the Captcha (Switch the 10 to any value to your liking)
        define("CAPTCHA", "10");
        
        
        define("database", array(
            "host" => "'.$host.'",
            "username" => "'.$username.'",
            "password" => "'.$password.'",
            "database" => "'.$database.'"
        ));
        
        ?>';

		// Write on the file
        fwrite ($myfile, $txt);

		// Close the file
        fclose ($myfile);

		// Test the connection using the given variables
        try 
        {
            // Connection
            $connect = new PDO("mysql:host=".$host.";dbname=".$database."", $username, $password);

            // Set the PDO error mode to exception
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        } 
        // Catches the errors
        catch(PDOException $e) 
        {
			// Show error to user
            $message = array(
                "type" => "danger",
                "text" => $e->getMessage()
            );

            $_SESSION['message'] = $message;	

            return false;
        }
        
        return true;
		
    }

    /**
	 * Handles the user messages (errors, warnings, success)
	 * 
     * @param	: $message (array)
	 * @return	: echo with message (HTML Element)
	*/
    public static function userMessage($message)
    {
        if (!empty($message))
        {
            echo "<div class='alert alert-".$message["type"]."' role='alert'>".$message["text"]."</div>";
        }
    }
}