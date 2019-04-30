<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

//use Symfony\Component\HttpFoundation\Response; //???
//use Symfony\Component\Validator\Validator\ValidatorInterface; //Pour la validation des champs de mes forms
//use Symfony\Component\Translation\TranslatorInterface; //Pour passer le site en Anglais

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager; //Pour rendre persistent des valeurs de mon form

use App\Entity\Billet;
use App\Entity\Buyer;


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
        $billet = new Buyer();
        $billet->setCreatedAt(new \DateTime('tomorrow'));
        $choices = [
            'Journée' => 'valeur1',
            'Demi-journée' => 'valeur2'
        ];

        $form = $this->createFormBuilder($billet)
                     ->add('nbBillet', ChoiceType::class, [
                        'choices' => [
                            '0','1','2','3','4','5','6','7','8','9','10'
                        ]
                     ])
                     ->add('typeBillet', ChoiceType::class, [
                            'choices' => 'valeur1',
                                'choices' => $choices,
                                'expanded' => false,                            
                     ])
                     //->add('typeBillet', ChoiceType::class, [
                        //'choices' => [
                            //'Journée' => true,
                            //'Demi-journée' => false,
                        //]
                     //])
                     ->add('createdAt', DateType::class, [
                        'format' => 'ddMMyyyy',
                     ])
                     ->add('save', SubmitType::class)
                     ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $billet = $form->getCreatedAt();

            return $this->redirectToRoute("order_step_2");
        }

        $formBillet = $this->createFormBuilder($billet)
                     ->add('email', TextType::class)
                     ->add('typeBillet', ChoiceType::class, [
                            'choices' => [
                                'Journée' => true,
                                'Demi-journée' => false,
                            ]
                     ])
                     ->add('createdAt', DateType::class, [
                        'format' => 'ddMMyyyy',
                     ])
                     ->add('save', SubmitType::class)
                     ->getForm();

        $form->handleRequest($request);

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

        $form = $this->createFormBuilder($billet)
                     ->add('lastname')
                     ->add('name')
                     ->add('birthdayDate', BirthdayType::class, [
                        'format' => 'ddMMyyyy',
                     ])
                     ->add('save', SubmitType::class)
                     ->getForm();

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
