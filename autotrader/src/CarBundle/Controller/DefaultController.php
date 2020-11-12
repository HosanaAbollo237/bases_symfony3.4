<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    
    /**
     * @Route("/our-cars/", name="offer")
     */
    public function indexAction()
    {
        // (1) Recupération object doctrine + repo (2) récupération data
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        $cars = $carRepository->findAll();

        //dump($cars);

        //phpinfo();
        return $this->render('CarBundle/default/index.html.twig', [
            'cars' => $cars
        ]);
    }

    /**
     * @param $id
     * @Route("/our-cars/{id}", name="show_car")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id){
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        $car = $carRepository->find($id);

        return $this->render('CarBundle/default/show.html.twig',[
            'car' => $car
        ]);

    }
    
}
