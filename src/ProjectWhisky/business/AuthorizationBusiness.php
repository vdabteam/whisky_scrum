<?php

namespace src\ProjectWhisky\business;
use src\ProjectWhisky\data\UserDAO;
use src\ProjectWhisky\exceptions\LoginFailureException;




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
        if (!isset($this->lijst)) throw new LoginFailureException();


        /**
         * Get hashed password from DB and check if by user inserted password matches with hashed one.
         */
        $this->passwordHash = $this->lijst[0]->getPassword();
        $this->checkPassword($this->passwordHash, $this->password);

        /**
         * Check if account is verified
         */
        if($this->lijst[0]->getVerification() != 1) throw new EmailNotVerifiedException();

        return $this->lijst[0];

    }

}