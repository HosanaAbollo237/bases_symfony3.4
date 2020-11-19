<?php

namespace CarBundle\Controller;

use CarBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use CarBundle\Service\DataChecker;

use CarBundle\Entity\Model;
use CarBundle\Entity\Make;



/**
 * Car controller
 *
 * @Route("/admin/car")
 */
class CarController extends Controller
{

    /**
     * @param $id
     * promote a car
     * @Route("/promote/{id}", name="car_promote")
     */
    public function promoteAction($id){

        $dataChecker =$this->get('car.data_checker'); // récupérer service

        $em = $this->getDoctrine()->getEntityManager(); // récupérer em

        $car = $em->getRepository('CarBundle:Car')->find($id); // instance de l'entité car

        $result =  $dataChecker->checkCar($car); // récupération résultat check
        
        if($result){
            $this->addFlash('success', "car promoted");
        }
        else{
            $this->addFlash('warning', "car not applicable");
        }
        return $this->redirectToRoute("car_index");
    }


    /**
     * Lists all car entities.
     *
     * @Route("/", methods={"GET"}, name="car_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository('CarBundle:Car')->findAll();

        return $this->render('car/index.html.twig',array(
            'cars' => $cars,
        ));
    }

    /**
     * Creates a new car entity.
     *
     * @Route("/new", methods={"GET","POST"}, name="car_new")
     */
    public function newAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm('CarBundle\Form\CarType', $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_show', array('id' => $car->getId()));
        }

        return $this->render('car/new.html.twig', array(
            'car' => $car,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a car entity.
     * @param Car $car
     * @Route("/{id}", methods={"GET"}, name="car_show")
     */
    public function showAction($id)
    {

        $em = $this->getDoctrine()->getEntityManager(); 
        $car = $em->getRepository('CarBundle:Car')->find($id);

        $deleteForm = $this->createDeleteForm($car);

        return $this->render('car/show.html.twig', array(
            'car' => $car,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing car entity.
     *
     * @Route("/{id}/edit", methods={"GET", "POST"}, name="car_edit")
     */
    public function editAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getEntityManager(); 
        $car = $em->getRepository('CarBundle:Car')->find($id);

        $deleteForm = $this->createDeleteForm($car);


        $editForm = $this->createForm('CarBundle\Form\CarType', $car);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_edit', array('id' => $car->getId()));
        }

        return $this->render('car/edit.html.twig', array(
            'car' => $car,
            'edit_form' => $editForm->createView(),        
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Deletes a car entity.
     *
     * @Route("/{id}", methods={"DELETE"}, name="car_delete")
     */
    public function deleteAction(Request $request, Car $car)
    {
        $form = $this->createDeleteForm($car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($car);
            $em->flush();
        }

        return $this->redirectToRoute('car_index');
    }

    /**
     * Creates a form to delete a car entity.
     *
     * @param Car $car The car entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Car $car)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('car_delete', array('id' => $car->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
