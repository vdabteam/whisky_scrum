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
    
    //getters
    
    public function getId()
    {
        return $this -> id;
    }
    
    public function getUsername()
    {
        return $this -> username;
    }
    
    public function getPassword()
    {
        return $this -> password;
    }
    
    public function getEmail()
    {
        return $this -> email;
    }
    
    public function getFirstname()
    {
        return $this -> firstname;
    }
    
    public function getLastname()
    {
        return $this -> Lastname;
    }
        
    public function getAdmin()
    {
        return $this -> admin;
    }
        
    public function getBlocked()
    {
        return $this -> blocked;
    }
            
    public function getImagePath()
    {
        return $this -> imagePath;
    }
            
    public function getRegistrationDate()
    {
        return $this -> registrationDate;
    }
    
    //setters
    
    public function setId($id)
    {
        $this -> id = $id;
    }
    
    public function setUsername($username)
    {
        $this -> username = $username;
    }
    
    public function setPassword($password)
    {
        $this -> password = $password;
    }
    
    public function setPassword($password)
    {
        $this -> password = $password;
    }
    
    public function setEmail($email)
    {
        $this -> email = $email;
    }
    
    public function setFirstname($firstname)
    {
        $this -> firstname = $firstname;
    }
    
    public function setLastname($lastname)
    {
        $this -> lastname = $lastname;
    }
    
    public function setAdmin($admin)
    {
        $this -> admin = $admin;
    }
    
    public function setBlocked($blocked)
    {
        $this -> blocked = $blocked;
    }
    
    public function setImagePath($imagePath)
    {
        $this -> imagePath = $imagePath;
    }
    
    public function setRegistrationDate($registrationDate)
    {
        $this -> registrationDate = $registrationDate;
    }
        
}