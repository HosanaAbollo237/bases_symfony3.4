<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;


class DefaultController extends Controller
{   
    /**
     * @Route("/our-cars/", name="offer")
     */
    public function indexAction(Request $request)
    {
        $carRepository = $this->getDoctrine()->getRepository('CarBundle:Car');
        $cars = $carRepository->findCarWithDetails();

        $form = $this->createFormBuilder()
        ->setMethod('GET')
        ->add('search', TextType::class, [
            'constraints' => [
                new NotBlank(), // champ non vide
                new Length([
                    'min' => 2,
                    'minMessage' => 'La longueur du champ doit dépasser 2 caractères'
                    ]) // minimum 2 characters
            ]
        ])
        ->getForm();
        $form->handleRequest($request); // recupérer la requete du formulaire
        
        if($form->isSubmitted() && $form->isValid()){
            die("FORM SUBMITTED");
        }
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
