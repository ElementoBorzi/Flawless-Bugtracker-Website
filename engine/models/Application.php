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
		// Open .env file (if it doesn't exist, creates it
        $fileName = fopen ("../.env", "w") or die("Unable to open file!");
    
		// Text to insert on the file
        $text = "
ACP_PASSWORD=\"$acpPassword\"

# Website Information
WEB_TITLE=\"$title\"
WEB_HEADER=\"$header\"

# Number of letters on the Captcha (Switch the 10 to any value to your liking)
CAPTCHA=10

# Database Information
DATABASE_HOST=\"$host\"
DATABASE_USERNAME=\"$username\"
DATABASE_PASSWORD=\"$password\"
DATABASE_NAME=\"$database\"
";


		// Write on the file
        fwrite ($fileName, $text);

		// Close the file
        fclose ($fileName);

		// Test the connection using the given variables
        try 
        {
            // Connection
            $connect = new PDO("mysql:host=".$host."", $username, $password);

            // Set the PDO error mode to exception
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

            if ($connect)
            {
                // Create database if it doesn't exist
                $connect->exec("CREATE DATABASE IF NOT EXISTS ".$database.";");

                // Select the database
                $connect->exec("USE ".$database.";");

                // Open database/*.sql files and execute them 
                foreach (glob("database/*.sql") as $filename) 
                {
                    $sql = file_get_contents($filename);
                    $connect->exec($sql);
                }
            }

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