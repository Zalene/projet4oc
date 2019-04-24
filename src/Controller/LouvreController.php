<?php

namespace App\Controller;

use App\Entity\Billet;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


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
    public function order(Request $request)
    {
        $billet = new Billet();
        $billet->setDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($billet)
                     ->add('nbBillet', ChoiceType::class, [
                            'choices' =>[
                                '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                                '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                                '', '', '', '', '', '', '', '', '', '', '', '', '', '', '50',
                            ]
                     ])
                     ->add('typeBillet', ChoiceType::class, [
                            'choices' =>[
                                'Journée' => true,
                                'Demi-journée' => false,
                            ]
                     ])
                     ->add('date', DateType::class)
                     ->add('save', SubmitType::class)
                     ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute("order_step_2");
        }

        dump($billet);

        return $this->render('louvre/order.html.twig', [
            'formStep1' => $form->createView()
        ]);
    }

    /**
     * @Route("/information", name="order_step_2")
     */
    public function information(Request $request)
    {   
        $billet = new Billet();
        $billet->setDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($billet)
                     ->add('lastname')
                     ->add('name')
                     ->add('birthdayDate', DateType::class)
                     ->add('save', SubmitType::class)
                     ->getForm();

        return $this->render('louvre/information.html.twig', [
            'formStep2' => $form->createView()
        ]);
    }

}
