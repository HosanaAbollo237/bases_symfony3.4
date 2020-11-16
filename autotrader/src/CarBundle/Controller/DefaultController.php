<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{   
    /**
     * @Route("/our-cars/", name="offer")
     */
    public function indexAction()
    {
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        $cars = $carRepository->findCarWithDetails();

        $form = $this->createFormBuilder()
        ->setMethod('GET')
        ->add('search', TextType::class)
        ->getForm();

        return $this->render('CarBundle/default/index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @Route("/our-cars/{id}", name="show_car")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id){
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        $car = $carRepository->findCarWithDetailsById($id);

        return $this->render('CarBundle/default/show.html.twig',[
            'car' => $car,
        ]);

    }
    
}
