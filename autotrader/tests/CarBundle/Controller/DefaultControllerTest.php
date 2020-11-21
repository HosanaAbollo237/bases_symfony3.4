<?php

namespace Tests\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

       // $this->assertSame(1, $crawler->filter('h1')->count());
        $this->assertSame(0, $crawler->filter('html:contains("Fabricant")')->count());
       
       //$this->assertContains('Nos offres', $crawler->filter('h1')->text());        
    }
}
