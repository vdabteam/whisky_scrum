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


    /**
     * Get user data by user id: firstname, lastname, e-mail, user image path
     */
    public function getSomeDataByUserId($userId)
    {
        self::connectToDB(); /* Using DB connection */

        $this->sql = "SELECT firstname, lastname, email, image_path FROM users WHERE id = ?";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($userId));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            /**
             * Closing DB connection
             */
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



    /**
     * Update user data by user id: firstname, lastname, e-mail
     */
    public function updateSomeDataByUserId($userId, $firstname, $lastname, $email)
    {
        self::connectToDB(); /* Using DB connection */

        $this->sql = "UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE id = ?";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($firstname, $lastname, $email, $userId));

            /**
             * Closing DB connection
             */
            $this->query->closeCursor();
            $this->handler = null;

            return true;
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

            /**
             * Closing DB connection
             */
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


    /**
     * Creating new user
     * registration_date uses NOW() function for current date
     * admin and blocked filled as default values = 0
     */
    public function createUser($username, $password, $email, $firstname, $lastname)
    {
        self::connectToDB(); /* Using DB connection */

        $this->sql = "INSERT INTO users (
                                    username,
                                    password,
                                    email,
                                    firstname,
                                    lastname,
                                    registration_date
                                    )
                        VALUES (?, ?, ?, ?, ?, NOW())";


        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($username, $password, $email, $firstname, $lastname));

            /**
             * Closing DB connection
             */
            $this->query->closeCursor();
            $this->handler = null;

            return true;


        }
        catch(Exception $e){
            echo "Error: query failure";
            die();
        }
    }


    /**
     * Only checking whether username already exists
     */
    public function lookForUserByUsername($username)
    {
        self::connectToDB(); /* Using DB connection */

        $this->sql = "SELECT username FROM users WHERE username = ?";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($username));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            /**
             * Closing DB connection
             */
            $this->query->closeCursor();
            $this->handler = null;

            return $this->result;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }



    /**
     * Only checking whether email already exists
     */
    public function lookForUserByEmail($email)
    {
        self::connectToDB(); /* Using DB connection */

        $this->sql = "SELECT email FROM users WHERE email = ?";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($email));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            /**
             * Closing DB connection
             */
            $this->query->closeCursor();
            $this->handler = null;

            return $this->result;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }



    public function getPasswordByUserId($userId)
    {
        self::connectToDB(); /* Using DB connection */

        $this->sql = "SELECT password FROM users WHERE id = ?";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($userId));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            /**
             * Closing DB connection
             */
            $this->query->closeCursor();
            $this->handler = null;

            return $this->result[0]['password'];
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }



    public function insertNewPasswordByUserId($userId, $newHashedPassword)
    {
        self::connectToDB(); /* Using DB connection */

        $this->sql = "UPDATE users SET password = ? WHERE id = ?";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($newHashedPassword, $userId));

            /**
             * Closing DB connection
             */
            $this->query->closeCursor();
            $this->handler = null;

            return true;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }

}