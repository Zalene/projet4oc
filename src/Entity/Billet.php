<?php

namespace App\Entity;

class Billet
{
    protected $nbBillet;
    protected $date;
    protected $typeBillet;

    public function getNbBillet()
    {
        return $this->nbBillet;
    }

    public function setNbBillet($nbBillet)
    {
        $this->nbBillet = $nbBillet;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date = null)
    {
        $this->date = $date;
    }

    public function getTypeBillet()
    {
        return $this->typeBillet;
    }

    public function setTypeBillet($typeBillet)
    {
        $this->typeBillet = $typeBillet;
    }
}