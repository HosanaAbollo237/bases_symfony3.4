<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\CssSelector\CssSelectorConverter;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to AutoTracker', $crawler->filter('h1')->text());
    }


    public function testOffer(){

        $client = static::createClient();
        $crawler = $client->request('GET', '/our-cars');
        
        $this->assertEquals(2, $crawler->filter('tr > td')->count());

        $this->assertGreaterThan(
            0,
            $crawler->filter('a')->count()
        );

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'text/html; charset=UTF-8'
            )
        );
    
        

   /*     $crawler->client($link);
        $this->assertContains('Z3', $crawler->filter('h1')->text());*/

    }
}
