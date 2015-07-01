<?php

namespace src\ProjectWhisky\business;
use src\ProjectWhisky\data\UserDAO;
use src\ProjectWhisky\exceptions\WrongDataException;



class UserBusiness
{
    private $userDAO;
    private $list;

    /**
     * Getting all information from all users
     */
    public function getAllUsers()
    {
        $this->userDAO = new UserDAO();
        $this->list = $this->userDAO->getAll();
        return $this->list;
    }


    /**
     * Searching user by email
     */
    public function searchUserByEmail($email)
    {
        $this->userDAO = new UserDAO();
        $this->list = $this->userDAO->findUserByEmail($email);

        if(!isset($this->list)) throw new WrongDataException();
        return $this->list;

    }


    /**
     * Creating new user
     */
    public function createNewUser($username, $password, $email, $firstname, $lastname)
    {
        $password = self::hashPassword($password);
        $this->userDAO = new UserDAO();
        $this->list = $this->userDAO->createUser($username, $password, $email, $firstname, $lastname);

        return $this->list;
    }

    public function hashPassword($passwordToHash, $rounds = 10)
    {
        $crypt_options = array('cost' => $rounds);
        $hash = password_hash($passwordToHash, PASSWORD_BCRYPT, $crypt_options);
        return $hash;
    }



    /**
     * Checking user by username
     */
    public function checkUserByUsername($username)
    {
        $this->userDAO = new UserDAO();
        $this->list = $this->userDAO->lookForUserByUsername($username);

        return $this->list;
    }


    /**
     * Checking user by email
     */
    public function checkUserByEmail($email)
    {
        $this->userDAO = new UserDAO();
        $this->list = $this->userDAO->lookForUserByEmail($email);

        return $this->list;
    }

}