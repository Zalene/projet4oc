<?php

namespace App\Tests;

use App\Entity\Billet;
use PHPUnit\Framework\TestCase;

class BIlletTest extends TestCase
{
    /**
     * Test de la class Billet et des getters et setters
     */
    public function testBuyer()
    {
        $date = new \DateTime;

        $billet = new Billet();
        $billet->setFirstname('Just');
        $billet->setName('Leblanc');
        $billet->setBirthday($date);
        $billet->setCountry('FR');
        $billet->setReducedPrice(false);
        $billet->setPrice(50);

        $this->assertEquals('Just', $billet->getFirstname());
        $this->assertEquals('Leblanc', $billet->getName());
        $this->assertEquals($date, $billet->getBirthday());
        $this->assertEquals('FR', $billet->getCountry());
        $this->assertEquals(false, $billet->getReducedPrice());
        $this->assertEquals(50, $billet->getPrice());
    }
}