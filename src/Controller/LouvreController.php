<?php

namespace App\Controller;

use App\Entity\Billet;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $billet->setNbBillet('1');
        $billet->setDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($billet)
                     ->add('nbBillet', TextType::class, ['label' => 'Nombre de billet'])
                     ->add('typeBillet', TextType::class, ['label' => 'Type de billet'])
                     ->add('date', DateType::class, ['label' => 'Date de visite'])
                     ->add('save', SubmitType::class, ['label' => 'Envoyer'])
                     ->getForm();

        return $this->render('louvre/order.html.twig', [
            'formStep1' => $form->createView()
        ]);
    }
}
