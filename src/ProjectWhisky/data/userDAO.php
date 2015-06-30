<?php

namespace src\ProjectWhisky\data;
use src\ProjectWhisky\data\DBConnect;
use src\ProjectWhisky\entities\User;
use PDO;
use Exception;


class UserDAO
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


    /**
     * Getting all information from all users
     */
    public function getAll()
    {
        self::connectToDB(); /* Using DB connection */

        $this->sql = "SELECT * FROM users";

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
                $this->list[] = new User($row['id'], $row['username'], $row['password'], $row['email'], $row['firstname'], $row['lastname'], $row['admin'], $row['blocked'], $row['image_path'], $row['registration_date']);
            }
            return $this->list;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }




    public function findUserByEmail($userEmail)
    {
        self::connectToDB(); /* Using DB connection */

        $this->sql = "SELECT * FROM users WHERE email = ?";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($userEmail));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query->closeCursor();
            $this->handler = null;

            foreach ($this->result as $row)
            {
                $this->list = new User($row['id'], $row['username'], $row['password'], $row['email'], $row['firstname'], $row['lastname'], $row['admin'], $row['blocked'], $row['image_path'], $row['registration_date']);
            }


            return $this->list;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }




    /*
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
                $this->lijst[] = new Films($row['film_id'], $row['film_naam'], $row['film_omschrijving'], $row['film_image'], 0);
            }
            return $this->lijst;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }

    }
    */
}