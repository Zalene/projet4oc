<?php

namespace App\Tests;

use App\Entity\Billet;

use PHPUnit\Framework\TestCase;

class AgeTest extends TestCase
{
    /**
     * Age du visiteur lors date de la visite
     * @dataProvider dateProvider
     * @param $birthday
     * @param $expected
     * @param $visitDay
     */
    public function testAgeDiffByDates($birthday, $expected, $visitDay)
    {
        $visitor = new Billet();
        $birthday = $this->createDateFromFormat($birthday);
        $visitDay = $this->createDateFromFormat($visitDay);
        $visitor->setBirthday($birthday);

        $this->assertNotNull($birthday, $visitDay);
        $this->assertEquals($expected, $visitor->getAge($visitDay));
    }

    // Date de naissance définie - âge prévu lors de la visite - date de la visite
    public function dateProvider()
    {
        return [
            ['05/07/1990', 29, '26/08/2019'],
            ['23/09/1974', 45, '12/09/2020'],
            ['11/02/1942', 83, '11/12/2025'],
            ['16/04/2002', 17, '08/08/2019'],
            ['27/10/2015', 4, '03/01/2020']
        ];
    }

    // Créer une date au format j/m/a
    private function createDateFromFormat($date)
    {
        return \DateTime::createFromFormat('d/m/Y', $date);
    }
}
