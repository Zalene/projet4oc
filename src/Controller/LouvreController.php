<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//use Symfony\Component\HttpFoundation\Response; //???
//use Symfony\Component\Validator\Validator\ValidatorInterface; //Pour la validation des champs de mes forms
//use Symfony\Component\Translation\TranslatorInterface; //Pour passer le site en Anglais

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager; //Pour rendre persistent des valeurs de mes forms

use App\Entity\Billet;
use App\Entity\Buyer;
use App\Form\BuyerType;
use App\Form\BilletType;


class LouvreController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {   
        $directory = getcwd();
        return $this->render('louvre/index.html.twig', [
            'controller_name' => 'AccueilController',
            'directory' => $directory
        ]);
    }

    /**
     * @Route("/order", name="order_step_1")
     */
    public function order(Request $request, ObjectManager $manager)
    {
        $buyer = new Buyer();
        $buyer->setCreatedAt(new \DateTime('tomorrow'));

        $form = $this->createForm(BuyerType::class, $buyer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            

            return $this->redirectToRoute("order_step_2");
        }

        return $this->render('louvre/order.html.twig', [
            'formStep1' => $form->createView()
        ]);
    }

    /**
     * @Route("/information", name="order_step_2")
     */
    public function information(Request $request, ObjectManager $manager)
    {   
        $billet = new Billet();

        $form = $this->createForm(BilletType::class, $billet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $billet = $form->getCreatedAt();

            return $this->redirectToRoute("order_step_3");
        }

        return $this->render('louvre/information.html.twig', [
            'formStep2' => $form->createView()
        ]);
    }

    /**
     * @Route("/checkout", name="order_step_3")
     */
    public function checkout()
    {   
        return $this->render('louvre/checkout.html.twig');
    }

    /**
     * @Route("/confirmation", name="order_step_4")
     */
    public function confirmation()
    {   
        return $this->render('louvre/confirmation.html.twig');
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentionsLegales()
    {   
        return $this->render('louvre/mentions.html.twig');
    }

}
