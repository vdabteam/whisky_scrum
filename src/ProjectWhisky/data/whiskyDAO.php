<?php

namespace src\ProjectWhisky\data;
use src\ProjectWhisky\data\DBConnect;
use src\ProjectWhisky\entities\Whisky;
use PDO;
use Exception;


class WhiskyDAO
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
        $this->sql = "SELECT * FROM whiskies";

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
                $this->list[] = new Whisky($row['id'], $row['name'], $row['distillery_id'], $row['price'], $row['age'],
                                            $row['strength'], $row['barrel_id'], $row['image_path'], $row['hidden'], $row['creation_date'],
                                            $row['rating_aroma'],$row['rating_color'],$row['rating_taste'],$row['rating_aftertaste'],
                                            $row['text_aroma'],$row['text_color'],$row['text_taste'],$row['text_aftertaste'],$row['review'],
                                            $row['user_id']);
            }

            return $this->list;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }
    public function getWhiskyById($id)
    {
       self::connectToDB();
        $this->sql = "SELECT whiskies.id as whiskiesid, whiskies.name AS whiskiesname, distillery_id, price, age, strength, barrel_id, image_path, hidden, creation_date, rating_aroma, rating_color, rating_taste, rating_aftertaste, text_aroma, text_color, text_taste, text_aftertaste, review, user_id, distilleries.id 
        FROM whiskies, distilleries
        WHERE whiskies.id = :id AND distillery_id = distilleries.id";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array('id'=> $id));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query->closeCursor();
            $this->handler = null;

            

            foreach ($this->result as $row)
            {
                $this->list = new Whisky($row['whiskiesid'], $row['whiskiesname'], $row['distillery_id'], $row['price'], $row['age'],
                                            $row['strength'], $row['barrel_id'], $row['image_path'], $row['hidden'], $row['creation_date'],
                                            $row['rating_aroma'],$row['rating_color'],$row['rating_taste'],$row['rating_aftertaste'],
                                            $row['text_aroma'],$row['text_color'],$row['text_taste'],$row['text_aftertaste'],$row['review'], 
                                            $row['user_id']);
            }
            return $this->list;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        } 
    }
    // GetWhiskyByDistillery - T
    public function getWhiskyByDistillery($distilleryId)
    {
       self::connectToDB();
        $this->sql = "SELECT whiskies.id as whiskiesid, whiskies.name AS whiskiesname, age, strength, type, price
        FROM distilleries inner join (whiskies inner join barrels on barrel_id = barrels.id) on distilleries.id = whiskies.distillery_id
        WHERE distilleries.id = $distilleryId";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute();
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query->closeCursor();
            $this->handler = null;

            

            foreach ($this->result as $row)
            {
                $whisky = array($row['whiskiesid'], $row['whiskiesname'], $row['age'], $row['strength'], $row['type'], $row['price']);
                $this->list[] = $whisky;
                
            }
            return $this->list;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }    
/* ======== even in comment gezet tot het terug gebruikt word ========
    public function getFilmById($filmId)
    {
        self::connectToDB();
        $this->sql = "SELECT * FROM films WHERE film_id = ?";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($filmId));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query->closeCursor();
            $this->handler = null;

            foreach ($this->result as $row)
            {
                $this->list[] = new Films($row['film_id'], $row['film_naam'], $row['film_omschrijving'], $row['film_image'], 0);
            }
            return $this->list;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }
*/


}
