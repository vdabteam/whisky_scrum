<?php

namespace src\ProjectWhisky\entities;


class User
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $firstname;
    private $lastname;
    private $admin;
    private $blocked;
    private $imagePath;
    private $registrationDate;


    private function __construct($id, $username, $password, $email, $firstname, $lastname, $admin, $blocked, $imagePath, $registrationDate)
    {
        $this -> id = $id;
        $this -> username = $username;
        $this -> password = $password;
        $this -> email = $email;
        $this -> firstname = $firstname;
        $this -> lastname = $lastname;
        $this -> admin = $admin;
        $this -> blocked = $blocked;
        $this -> imagePath = $imagePath;
        $this -> registrationDate = $registrationDate;
    }

    public static function create($id, $username, $password, $email, $firstname, $lastname, $admin, $blocked, $imagePath, $registrationDate)
    {
        $user = new User($id, $username, $password, $email, $firstname, $lastname, $admin, $blocked, $imagePath, $registrationDate);
        
        return $user;
    }
    
    public function getId()
    {
        return $this -> id;
    }

}