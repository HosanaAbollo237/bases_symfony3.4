<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/our-cars/", name="offer")
     */
    public function indexAction()
    {

        $cars = [
            ['make' => 'BMW', 'name' => 'X'],
            ['make' => 'Citroen', 'name' => 'B'],
            ['make' => 'Fiat', 'name' => 'XZ'],
            ['make' => 'Mercedes', 'name' => 'O']
        ];
        //phpinfo();
        return $this->render('CarBundle/default/index.html.twig', [
            'cars' => $cars
        ]);
    }
    
}
