<?php

class Common extends Database {

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


}