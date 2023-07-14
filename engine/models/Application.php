<?php
class Application {

    public static $error = "";

    public static function AppInit()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        self::loadView($page);
    }

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

    public static function assign($var1, $var2)
    {
        define($var1, $var2);
    }

    public static function error($error)
    {
		if (file_exists(ERROR_PATH ."/". $error .".php"))
        {
			ob_clean();
			require ERROR_PATH ."/". $error .".php";
			die();
		}
	}

    public static function install($host, $username, $password, $database, $title, $header, $acpPassword)
    {
		// Open db_config.php file
        $myfile = fopen ("../db-config.php", "w") or die("Unable to open file!");
    
		// Text to insert on the file
        $txt = '
        <?php
        define ("database", array(
            "host" => "'.$host.'",
            "username" => "'.$username.'",
            "password" => "'.$password.'",
            "database" => "'.$database.'"
        ));
        
        
        #Admin Control Panel Password
        define ("ACP_PASSWORD", "'.$acpPassword.'");	
        
        #Website Information
        define ("HEADER", "'.$header.'");
        define ("TITLE", "'.$title.'");
        
        #Number of letters on the Captcha (Switch the 10 to any value to your liking)
        define ("CAPTCHA", "10");
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