<?php

namespace src\ProjectWhisky\business;
use src\ProjectWhisky\data\DistilleryDAO;



class DistilleryBusiness
{
    public function getDistilleryList() 
    {
        $DistilleryDAO = new DistilleryDAO();
        $DistilleryList = $DistilleryDAO->getAll();
        return $DistilleryList;
    }
    public function getDistillery($id)
    {
        $DistilleryDAO = new DistilleryDAO();
        $distillery = $DistilleryDAO->getById($id);
        return $distillery;
    }
    public function getByWhisky($whiskyId)
    {
        $DistilleryDAO = new DistilleryDAO();
        $distillery =$DistilleryDAO->getDistilleryByWhiskyId($whiskyId);
        return $distillery;
    }
        public function getRegionList()
    {
        $DistilleryDAO = new DistilleryDAO();
        $regionList =$DistilleryDAO->getRegions();
        return $regionList;
    }
}