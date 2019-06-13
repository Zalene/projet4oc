<?php

namespace App\Tests;

Use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlTest extends WebTestCase
{
    /**
     * @dataProvider urlProviderSuccessful
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);
        
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * @dataProvider urlProviderNotFound
     */
    public function testNotFoundPages($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);
        
        $this->assertFalse($client->getResponse()->isNotFound());
    }

    // Les pages accessible
    public function urlProviderSuccessful()
    {
        
        yield ['/'];
        yield ['/order'];
        yield ['/mentions'];
        
    }

    // Les pages non accessible
    public function urlProviderNotFound()
    {
        yield ['/information'];
        yield ['/checkout'];
        yield ['/confirmation'];
    }
}
