<?php

namespace src\ProjectWhisky\business;
use src\ProjectWhisky\data\UserDAO;
use src\ProjectWhisky\exceptions\WrongDataException;
use src\ProjectWhisky\exceptions\PasswordFailureException;



class AuthorizationBusiness
{
    private $userDAO;
    private $list;
    private $email;
    private $password;
    private $passwordHash;

    /**
     * Login authorization
     */
    public function authorize($email, $password)
    {
        $this->email = $email;
        $this->password = $password;

        /**
         * Chech if user exists in DB
         */
        $this->userDAO = new UserDAO();
        $this->list = $this->userDAO->findUserByEmail($this->email);

        /**
         * Report exception if user doesn't exit
         */
        if (!isset($this->list)) throw new WrongDataException();


        /**
         * Get hashed password from DB and check if by user inserted password matches with hashed one.
         */
        $this->passwordHash = $this->list->getPassword();
        self::checkPassword($this->passwordHash, $this->password);

        return $this->list;

    }


    /**
     * Checking whether entered password is correct
     */
    private function checkPassword($passwordHash, $passwordEntered)
    {
        if(!password_verify($passwordEntered, $passwordHash)) throw new PasswordFailureException(); // todo: change exception to "DataFailureException()"
    }

}