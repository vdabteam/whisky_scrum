<?php

namespace src\ProjectWhisky\business;
use src\ProjectWhisky\data\BarrelDAO;



class BarrelBusiness
{
    public function showAllBarrels()
    {
        $barrelDAO = new BarrelDAO();
        $barrelList = $barrelDAO->getAll();
        return $barrelList;
    }
    
    
    public function showBarrel($whiskyId) 
    {
        $barrelDAO = new BarrelDAO();
        $barrel = $barrelDAO->getBarrelByWhisky($whiskyId);
        return $barrel;
    }
}