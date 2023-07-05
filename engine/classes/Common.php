<?php
/**
 * This class is used to store common functions
 *
 * @name	: Common.php
 * @package	: Bugtracker
 * @author	: Pluton <ferreirawow@gmail.com>
 * @link	: --
 * @version	: 1.0
*/
class Common extends Database {

    /**
	 * Generates a random string that will act as a Captcha
	 * 
	 * @param	: $length (string)
	 * @return	: $_SESSION['captcha']
	*/
    public function generateCaptcha($length)
    {
        if (isset($_SESSION['captcha']))
        {
            unset($_SESSION["captcha"]);
        } 

        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randomString = "";

        for ($i = 0; $i < $length; $i++) 
        {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $_SESSION['captcha'] = $randomString;

        return $_SESSION['captcha'];
    }

    /**
	 * Verifies if a string matches the current captcha
	 * 
	 * @param	: $captchaCode (string)
	 * @return	: bool
	*/
    public function verifyCaptcha($captchaCode)
    {
        if ($captchaCode == $_SESSION['captcha'])
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
	 * Converts a string to a specific length
	 * 
     * @param	: $X (string)
	 * @param	: $length (integrer)
	 * @return	: $y (string)
	*/
    public function customEcho($x, $length) 
    {
        if(strlen($x)<=$length) 
        {
            return $x;
        } 
        else 
        {
            $y=substr($x,0,$length) . '...';
            return $y;
        }
    }

    /**
	 * Gets a specific category name
	 * 
	 * @param	: $categoryId (integrer)
	 * @return	: $row['name'] (string)
	*/
    public function getCategoryName ($categoryId) 
    {
        $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".category WHERE id = ?");
        $stmt->execute([$categoryId]);

        if ($stmt->rowCount()) 
        {
            while ($row = $stmt->fetch()) 
            {
                return $row['name'];
            }
        }
    }

    /**
	 * Gets a specific priority name
	 * 
	 * @param	: $tagsId (integrer)
	 * @return	: $row['name'] (string)
	*/
    public function getPriorityName ($tagsId) 
    {
        $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".tags WHERE id = ?");
        $stmt->execute([$tagsId]);

        if ($stmt->rowCount()) 
        {
            while ($row = $stmt->fetch()) 
            {
                switch ($row['id'])
                {
                    case 1:
                        return "<span class='badge bg-danger'>".$row['name']."</span>";
                        break;
                    case 2:
                        return "<span class='badge bg-info text-dark'>".$row['name']."</span>";
                        break;
                    case 3: 
                        return "<span class='badge bg-warning text-dark'>".$row['name']."</span>";
                        break;
                }
            }
        }
    }

    /**
	 * Gets a specific Status name
	 * 
	 * @param	: $statusId (integrer)
	 * @return	: $row['name'] (string)
	*/
    public function getStatusName ($statusId) 
    {
        $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".status WHERE id = ?");
        $stmt->execute([$statusId]);

        if ($stmt->rowCount()) 
        {
            while ($row = $stmt->fetch()) 
            {
                return $row['name'];
            }
        }
    }

    /**
	 * Checks if the user has the required permissions to view the page
	 * 
	 * @param	: $action (string)
     * @param	: $page (string)
	 * @return	: return page
	*/
    public function protect($action)
    {
        switch ($action)
        {
            case "user-is-logged":
                if (!isset($_SESSION['username']))
                {
                    header ("location: ?page=login");
                }
                break;

            case "admin-is-logged":
                if (!isset($_SESSION['admin']))
                {
                    header ("location: ?page=acp-login");
                }
                break;

            case "acp-rank-verify":
                if (!isset($_SESSION['rank']) >= 1)
                {
                    header ("location: ?page=home");
                }
                break;

        }
    }
}