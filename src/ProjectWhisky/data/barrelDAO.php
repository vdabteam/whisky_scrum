<?php

namespace src\ProjectWhisky\data;
use src\ProjectWhisky\data\DBConnect;
use src\ProjectWhisky\entities\Barrel;
use PDO;
use Exception;


class BarrelDAO
{
    private $result;
    private $handler;
    private $sql;
    private $query;
    private $list;


    /**
     * Defining constructor
     */
    public function __construct()
    {
    }

    /**
     * Method which creates a DB connection
     */
    private function connectToDB()
    {
        $this->handler = new DBConnect();
        $this->handler = $this->handler->startConnection();
    }


    public function getAll()
    {
        self::connectToDB(); /* Using DB connection */
        $this->sql = "SELECT * FROM barrels";

        try
        {
            $this->query = $this->handler->query($this->sql);
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);
            
             
             /**
             * Closing DB connection
             */
            $this->query->closeCursor();
            $this->handler = null;

            foreach ($this->result as $row)
            {
                $this->list[] = new Comment($row['id'], $row['type']);
            }

            return $this->list;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }

    public function getBarrelByWhisky($whiskyId)
    {
        self::connectToDB();
        $this->sql = "SELECT type, whiskies.id, barrels.id
        FROM barrels, whiskies
        WHERE barrels.id = barrel_id and whiskies.id = :whiskyId"  ;

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array('whiskyId'=> $whiskyId));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query->closeCursor();
            $this->handler = null;

            return $this->result[0];
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }


}