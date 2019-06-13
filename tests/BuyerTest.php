<?php

namespace App\Tests;

use App\Entity\Buyer;
use PHPUnit\Framework\TestCase;

class BuyerTest extends TestCase
{
    /**
     * Test de la class Buyer et des getters et setters
     */
    public function testBuyer()
    {
        $date = new \DateTime;

        $buyer = new Buyer();
        $buyer->setNbBillet(2);
        $buyer->setTypeBillet(1);
        $buyer->setCreatedAt($date);
        $buyer->setEmail('hello@gmail.com');
        $buyer->setVisitDay($date);
        $buyer->setCode('aFiu56Plk2');
        $buyer->setTotal(50);

        $this->assertEquals(2, $buyer->getNbBillet());
        $this->assertEquals(1, $buyer->getTypeBillet());
        $this->assertEquals($date, $buyer->getCreatedAt());
        $this->assertEquals('hello@gmail.com', $buyer->getEmail());
        $this->assertEquals($date, $buyer->getVisitDay());
        $this->assertEquals('aFiu56Plk2', $buyer->getCode());
        $this->assertEquals(50, $buyer->getTotal());
    }
}