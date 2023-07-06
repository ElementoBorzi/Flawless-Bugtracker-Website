<?php

/**
 * This class is used to store Bugs related functions
 *
 * @name	: Bugs.php
 * @package	: Bugtracker
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
    public function getCategories () 
    {
        $stmt = $this->connect()->query("SELECT * FROM ".DATABASE.".category ORDER by ID");

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
    public function getTags () 
    {
        $stmt = $this->connect()->query("SELECT * FROM ".DATABASE.".tags ORDER by ID");

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
    public function getStatus () 
    {
        $stmt = $this->connect()->query("SELECT * FROM ".DATABASE.".status ORDER by ID");

        if ($stmt->rowCount()) 
        {
            return $stmt;
        }
    }

    /**
	 * Gets the count of the existing bugs in database.
	 * 
	 * @return	: $totalRecords (string)
	*/
    public function getTotalRows()
    {
        ## Total number of records without filtering
        $stmt = $this->connect()->prepare("SELECT COUNT(*) AS allcount FROM ".DATABASE.".bugs");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        return $totalRecords;
    }

    /**
	 * Gets the count of the existing bugs in database.
	 * 
     * @param   : $searchQuery (string)
     * @param   : $searchArray (array)
	 * @return	: $totalRecordwithFilter (string)
	*/
    public function getTotalRowsFilter($searchQuery, $searchArray)
    {
        ## Total number of records with filtering
        $stmt = $this->connect()->prepare("SELECT COUNT(*) AS allcount FROM ".DATABASE.".bugs WHERE 1 ".$searchQuery);
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
    public function getAllBugs($searchArray, $searchQuery, $columnName, $columnSortOrder, $row, $rowperpage)
    {
        ## Fetch records
        $stmt = $this->connect()->prepare("SELECT * FROM bugs WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

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
    public function getBugDetails($bugId)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM ".DATABASE.".bugs WHERE id = ?");
        $stmt->execute([$bugId]);

        if ($stmt->rowCount()) 
        {
            return $stmt;
        }
    }

    /**
	 * Inserts a new bug in the database.
	 * 
     * @param   : $title (string)
     * @param   : $description (string)
     * @param   : $resources (string)
     * @param   : $author (string)
     * @param   : $category (string)
     * @param   : $tags (string)
	 * @return	: Success Message.
	*/
    public function insertBugs($title, $description, $resources, $author, $category, $tags)
    {
        $stmt= $this->connect()->prepare("INSERT INTO ".DATABASE.".bugs (title, description, resources, author, category, tags, status) 
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
        echo "<div class='alert alert-success' role='alert'><b>Success!</b> Your bug has been submitted. Thank you for your contribution.</div>";
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
    public function updateBug($id, $category, $tags, $status)
    {
        $stmt= $this->connect()->prepare("UPDATE ".DATABASE.".bugs SET category=:category, tags=:tags, status=:status WHERE id=:id");

        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":category", $category);
        $stmt->bindValue(":tags", $tags);
        $stmt->bindValue(":status", $status);
        $stmt->execute();
        
        //Success Message & Refresh.
        header("Refresh:3");
        echo "<div class='alert alert-success' role='alert'><b>Success!</b> The bug #".$id." has been updated.</div>";
    }

    /**
	 * Deletes a existing bug.
	 * 
     * @param   : $id (string)
	 * @return	: Success Message.
	*/
    public function deleteBug($id)
    {
        $stmt= $this->connect()->prepare("DELETE FROM ".DATABASE.".bugs WHERE id=:id");

        $stmt->bindValue(":id", $id);
        $stmt->execute();
        
        //Success Message & Refresh.
        header("Location: ?page=acp-allbugs");
    }

}