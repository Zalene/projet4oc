<?php

namespace App\Tests;

use App\Entity\Buyer;
use App\Entity\Billet;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\TestCase;


class OrderTest extends WebTestCase
{
    // Teste la réservation
    public function testBuyerFormEmpty()
    {
        $buyer = [];
        $this->assertEmpty($buyer);

        return $buyer;

        /*$client = self::createClient();

        $crawler = $client->request('GET', '/order');*/

        //$formBuyer = $crawler->selectButton('submit')->form();

        /*$formBuyer['buyer[visitDay]'] = '26/02/2020';
        $formBuyer['buyer[nbBillet]'] = 2;
        $formBuyer['buyer[email]'] = 'hello@gmail.com';
        $formBuyer['buyer[typeBillet]'] = 1;

        dd($formBuyer);

        $crawler = $client->submit($formBuyer);

        $this->assertTrue($client->getResponse()->isRedirect('/billets'));

        $crawler = $client->followRedirect();

        dd($crawler);


        $visitDay = '26/02/2020';
        $nbBillet = 2;
        $typeBillet = 1;
        $email = 'test@gmail.com';
        $visitDay = $this->createDateFromFormat($visitDay);
        $buyer->setVisitDay($visitDay);
        $buyer->setNbBillet($nbBillet);
        $buyer->setTypeBillet($typeBillet);
        $buyer->setEmail($email);*/
    }

    /**
     * @depends testBuyerFormEmpty
     */
    public function testBuyerForm(array $buyer)
    {
        array_push($buyer, ['26/02/2020', 1]);
        $this->assertSame(['26/02/2020', 1], $buyer[count($buyer)-1]);
        $this->assertNotEmpty($buyer);

        return $buyer;
    }

    /**
     * @depends testBuyerForm
     */
    public function testBuyerFormPush(array $buyer)
    {
        dd($buyer);
        $this->assertSame(['26/02/2020', 1], array_pop($buyer));
        $this->assertEmpty($buyer);
    }

    // Créer une date au format j/m/a
    private function createDateFromFormat($date)
    {
        return \DateTime::createFromFormat('d/m/Y', $date);
    }
}
