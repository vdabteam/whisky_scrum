<?php

namespace src\ProjectWhisky\helpers;
use src\ProjectWhisky\exceptions\WrongDataException;


class ValidationHelpers
{
    private $userDAO;
    private $list;
    private $email;
    private $userId;
    private $password;
    private $passwordHash;


    /**
     * Hash passwords
     */
    public function hashPassword($passwordToHash, $rounds = 10)
    {
        $crypt_options = array('cost' => $rounds);
        $hash = password_hash($passwordToHash, PASSWORD_BCRYPT, $crypt_options);
        return $hash;
    }

    /**
     * Checking whether entered password is correct or not
     */
    protected function checkPassword($passwordHash, $passwordEntered)
    {
        if(!password_verify($passwordEntered, $passwordHash)) throw new WrongDataException();
    }

}