<?php

namespace src\ProjectBioscoop\entities;


class Films
{
    private $filmId;
    private $filmNaam;
    private $filmOmschrijving;
    private $filmImage;
    private $programmatie;


    public function __construct($filmId, $filmNaam, $filmOmschrijving, $filmImage, $programmatie)
    {
        $this->filmId = $filmId;
        $this->filmNaam = $filmNaam;
        $this->filmOmschrijving = $filmOmschrijving;
        $this->filmImage = $filmImage;
        $this->programmatie = $programmatie;
    }

    public function getFilmId()
    {
        return $this->filmId;
    }

    public function getFilmNaam()
    {
        return $this->filmNaam;
    }

    public function getFilmOmschrijving()
    {
        return $this->filmOmschrijving;
    }

    public function getFilmImage()
    {
        return $this->filmImage;
    }

    public function getFilmProgrammatie()
    {
        return $this->programmatie;
    }

}