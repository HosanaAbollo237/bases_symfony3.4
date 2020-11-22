<?php

namespace CarBundle\DataFixtures\ORM;

use CarBundle\Entity\Make;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadDictionnary extends Fixture {
    
    public function load(ObjectManager $manager){ 
        
        // 3 row a envoyé à la BDD
        $make = new Make();
        $make->setName('vw');
        
        $make1 = new Make();
        $make1->setName('BMW');
        
        $make2 = new Make();
        $make2->setName('Fiat');

        $manager->persist($make);
        $manager->persist($make1);
        $manager->persist($make2); 
        $manager->flush();
    }
}