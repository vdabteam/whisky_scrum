<?php

namespace src\ProjectWhisky\business;
use src\ProjectWhisky\data\UserDAO;
use src\ProjectWhisky\helpers\ValidationHelpers;
use src\ProjectWhisky\exceptions\WrongDataException;


class ProfileBusiness extends ValidationHelpers
{
    private $userDAO;
    private $newHashedPassword;
    private $passwordHash;
    private $list;


    /**
     * Checking if old password is correct
     */
    public function checkOldPassword($userId, $oldPassword)
    {
        /**
         * get password hash of specific user by userId
         */
        $this->userDAO = new UserDAO();
        $this->passwordHash = $this->userDAO->getPasswordByUserId($userId);

        self::checkPassword($this->passwordHash, $oldPassword); // Validate old password (using helpers)

        return true;
    }


    /**
     * Update old password
     */
    public function updateNewPassword($userId, $newPassword)
    {
        $this->newHashedPassword = self::hashPassword($newPassword); // Hash new password (using helpers)

        $updatedPassword = new UserDAO();

        return $updatedPassword->insertNewPasswordByUserId($userId, $this->newHashedPassword);

    }




    /**
     * Get user data by user id: firstname, lastname, e-mail, user image
     */
    public function getUserDataByUserId($userId)
    {
        $userDAO = new UserDAO();
        return $userDAO->getSomeDataByUserId($userId);
    }


    public function updateUserDataByUserId($userId, $firstname, $lastname, $email)
    {
        $userDAO = new UserDAO();
        return $userDAO->updateSomeDataByUserId($userId, $firstname, $lastname, $email);
    }



}