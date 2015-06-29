<?php

namespace src\ProjectBioscoop\business;
use src\ProjectBioscoop\data\ZaalDAO;

class ZaalBusiness
{
    private $zaalDAO;
    private $lijst;

    public function getZaalGrootte($zaalId)
    {
        $this->zaalDAO = new ZaalDAO();
        $this->lijst = $this->zaalDAO->getZaalById($zaalId);
        return $this->lijst;
    }
}