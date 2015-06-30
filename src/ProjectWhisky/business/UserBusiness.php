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

}