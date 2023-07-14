<?php

/**
 * This class is used to store Bugs related functions
 *
 * @name	: Bugs.php
 * @package	: Flawless
 * @author	: Pluton <ferreirawow@gmail.com>
 * @link	: --
 * @version	: 1.0
*/
class Bugs extends Database {

    /**
	 * Gets all the bugs Categories.
	 * 
	 * @return	: $stmt (array)
	*/
    public static function getCategories () 
    {
        $stmt = self::connect()->query("SELECT * FROM ".self::$database.".category ORDER by ID");

        if ($stmt->rowCount()) 
        {
            return $stmt;
        }
    }

    /**
	 * Gets all the bugs Tags.
	 * 
	 * @return	: $stmt (array)
	*/
    public static function getTags () 
    {
        $stmt = self::connect()->query("SELECT * FROM ".self::$database.".tags ORDER by ID");

        if ($stmt->rowCount()) 
        {
            return $stmt;
        }
    }

    /**
	 * Gets all the bugs Status.
	 * 
	 * @return	: $stmt (array)
	*/
    public static function getStatus () 
    {
        $stmt = self::connect()->query("SELECT * FROM ".self::$database.".status ORDER by ID");

        if ($stmt->rowCount()) 
        {
            return $stmt;
        }
    }

    /**
	 * Gets the count of the existing bugs in self::$database.
	 * 
	 * @return	: $totalRecords (string)
	*/
    public static function getTotalRows()
    {
        ## Total number of records without filtering
        $stmt = self::connect()->prepare("SELECT COUNT(*) AS allcount FROM ".self::$database.".bugs");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        return $totalRecords;
    }

    /**
	 * Gets the count of the existing bugs in self::$database.
	 * 
     * @param   : $searchQuery (string)
     * @param   : $searchArray (array)
	 * @return	: $totalRecordwithFilter (string)
	*/
    public static function getTotalRowsFilter($searchQuery, $searchArray)
    {
        ## Total number of records with filtering
        $stmt = self::connect()->prepare("SELECT COUNT(*) AS allcount FROM ".self::$database.".bugs WHERE 1 ".$searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];
        
        return $totalRecordwithFilter;
    }

    /**
	 * Gets existing bugs with filters and table definitions.
	 * 
     * @param   : $searchQuery (string)
     * @param   : $searchArray (array)
     * @param   : $columnName (string)
     * @param   : $columnSortOrder (string)
     * @param   : $row (string)
     * @param   : $rowperpage (string)
	 * @return	: $empRecords (array)
	*/
    public static function getAllBugs($searchArray, $searchQuery, $columnName, $columnSortOrder, $row, $rowperpage)
    {
        ## Fetch records
        $stmt = self::connect()->prepare("SELECT * FROM bugs WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

        // Bind values
        foreach($searchArray as $key=>$search)
        {
            $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        return $empRecords;
    }

    /**
	 * Gets the details of a specific bug.
	 * 
     * @param   : $bugId (string)
	 * @return	: $stmt (array)
	*/
    public static function getBugDetails($bugId)
    {
        $stmt = self::connect()->prepare("SELECT * FROM ".self::$database.".bugs WHERE id = ?");
        $stmt->execute([$bugId]);

        if ($stmt->rowCount()) 
        {
            return $stmt;
        }
    }

    /**
	 * Inserts a new bug in the self::$database.
	 * 
     * @param   : $title (string)
     * @param   : $description (string)
     * @param   : $resources (string)
     * @param   : $author (string)
     * @param   : $category (string)
     * @param   : $tags (string)
	 * @return	: Success Message.
	*/
    public static function insertBugs($title, $description, $resources, $author, $category, $tags)
    {
        $stmt= self::connect()->prepare("INSERT INTO ".self::$database.".bugs (title, description, resources, author, category, tags, status) 
        VALUES (:title, :description, :resources, :author, :category, :tags, :status)");

        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":resources", $resources);
        $stmt->bindValue(":author", $author);
        $stmt->bindValue(":category", $category);
        $stmt->bindValue(":tags", $tags);
        $stmt->bindValue(":status", "2");
        $stmt->execute();
        
        //Success Message & Refresh.
        header("Refresh:3");

        $message = array(
            "type" => "success",
            "text" => "<b>Success!</b> Your bug has been submitted. Thank you for your contribution."
        );

        $_SESSION['message'] = $message;
    }

    /**
	 * Updates existing bug information.
	 * 
     * @param   : $id (string)
     * @param   : $category (string)
     * @param   : $tags (string)
     * @param   : $status (string)
	 * @return	: Success Message.
	*/
    public static function updateBug($id, $category, $tags, $status)
    {
        $stmt= self::connect()->prepare("UPDATE ".self::$database.".bugs SET category=:category, tags=:tags, status=:status WHERE id=:id");

        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":category", $category);
        $stmt->bindValue(":tags", $tags);
        $stmt->bindValue(":status", $status);
        $stmt->execute();
        
        //Success Message & Refresh.
        header("Refresh:3");

        $message = array(
            "type" => "success",
            "text" => "<b>Success!</b> The bug #".$id." has been updated.</div>"
        );

        $_SESSION['message'] = $message;
    }

    /**
	 * Deletes a existing bug.
	 * 
     * @param   : $id (string)
	 * @return	: Success Message.
	*/
    public static function deleteBug($id)
    {
        $stmt= self::connect()->prepare("DELETE FROM ".self::$database.".bugs WHERE id=:id");

        $stmt->bindValue(":id", $id);
        $stmt->execute();
        
        //Success Message & Refresh.
        header("Location: ?page=acp-all-bugs");
    }
}