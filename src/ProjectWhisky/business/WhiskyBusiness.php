<?php

namespace src\ProjectWhisky\business;
use src\ProjectWhisky\data\WhiskyDAO;



class WhiskyBusiness
{
    public function getWhiskyList() 
    {
        $whiskyDAO = new WhiskyDAO();
        $whiskyList = $whiskyDAO->getAll();
        return $whiskyList;
    }
    public function getWhisky($id)
    {
        $whiskyDAO = new WhiskyDAO();
        $whisky = $whiskyDAO->getWhiskyById($id);
        return $whisky;
    }
}
