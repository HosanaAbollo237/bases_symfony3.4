<?php

namespace Test\CarBundle\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use CarBundle\Service\DataChecker;


class DataCheckerTest extends WebTestCase {

    // Nous n'utiliserons pas l'em du coups on utilisera le mock
    // On veut pas TOUTE l'implementation pour cette classe em  pour nos tests

    /**
     * @var EntityManager|\PHPUnit_Framework_MockObject_MockObject;
     * 
     */
    protected $entityManager;

    public function setUp(){

        // Création de l'objet mock
        $this->entityManager = $this->getMockBuilder('Doctrine\ORM\EntityManager')->disableOriginalConstructor()->getMock();
        
    }

    // Notre methode de test
    // Je veux savoir exactement ce que je veux et ce que cela va retourner
    public function testCheckCarWithRequiredPhotosWillReturnFalse(){
        // dateChecker instance
        $subject = new DataChecker($this->entityManager, true);

        // resulta attendu
        $expectedResult = false;

        $car = $this->getMockBuilder('CarBundle\Entity\Car')->getMock();

        $car->expects($this->once())
            ->method('setPromote')
            ->with($expectedResult);

            $this->entityManager->expects($this->once())
                ->method('persist')
                ->with($car);
            
                $this->entityManager->expects($this->once())
                ->method('flush');
                
        $result = $subject->checkCar($car);

        $this->assertEquals($expectedResult, $result);
    }
}