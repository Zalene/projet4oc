<?php

namespace App\Entity;

class Billet
{
    protected $nbBillet;
    protected $date;
    protected $typeBillet;
    protected $lastname;
    protected $name;
    protected $birthdayDate;

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

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBirthdayDate()
    {
        return $this->birthdayDate;
    }

    public function setBirthdayDate($birthdayDate)
    {
        $this->birthdayDate = $birthdayDate;
    }
}