<?php

namespace src\ProjectBioscoop\data;
use src\ProjectBioscoop\entities\Films;
use src\ProjectBioscoop\entities\Programmatie;
use src\ProjectBioscoop\data\DBConnect;
use PDO;
use Exception;


class FilmsDAO
{
    private $result;
    private $handler;
    private $sql;
    private $query;
    private $programmatie;

    private $lijst;


    public function __construct()
    {

    }


    private function connectToDB()
    {
        $this->handler = new DBConnect();
        $this->handler = $this->handler->startConnection();
    }

    public function getAll()
    {
        self::connectToDB();
        $this->sql = "SELECT * FROM films";

        try
        {
            $this->query = $this->handler->query($this->sql);
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query->closeCursor();
            $this->handler = null;

            foreach ($this->result as $row)
            {
                $this->programmatie = new ProgrammatieDAO();
                $this->programmatie = $this->programmatie->getProgrammatieTijdByFilmId($row['film_id']);

                $this->lijst[] = new Films($row['film_id'], $row['film_naam'], $row['film_omschrijving'], $row['film_image'], $this->programmatie);
            }

            return $this->lijst;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }


    public function getFilmById($filmId)
    {
        self::connectToDB();
        $this->sql = "SELECT * FROM films WHERE film_id = ?";

        try
        {
            $this->query = $this->handler->prepare($this->sql);
            $this->query->execute(array($filmId));
            $this->result = $this->query->fetchAll(PDO::FETCH_ASSOC);

            $this->query->closeCursor();
            $this->handler = null;

            foreach ($this->result as $row)
            {
                $this->lijst[] = new Films($row['film_id'], $row['film_naam'], $row['film_omschrijving'], $row['film_image'], 0);
            }
            return $this->lijst;
        }
        catch (Exception $e)
        {
            echo "Error: query failure";
            return false;
        }
    }


}