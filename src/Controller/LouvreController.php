<?php

namespace App\Controller;


use App\Entity\Buyer;
use App\Entity\Billet;
use App\Form\BuyerType;
use App\Form\BilletType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
        $sessionBag = $request->getSession();
        
        $buyer = new Buyer();

        $form = $this->createForm(BuyerType::class, $buyer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sessionBag->set('buyer', $buyer);

            //var_dump($sessionBag->get('buyer'));
            //die;

            //$manager->persist($buyer);
            //$manager->flush();

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
        $sessionBag = $request->getSession();
        $buyer = $sessionBag->get('buyer');

        if (!$buyer) {
            return $this->redirectToRoute('order_step_1');
        }
        
        $nbVisitor=$buyer->getNbBillet();
   
        for ($i=0;$i<$nbVisitor;$i++){
            $billet[] = new Billet();
        }

        $form = $this ->get('form.factory') ->create(CollectionType::class, $billet, ['entry_type' => BilletType::class]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sessionBag->set('buyer', $buyer, 'billet', $billet);
            
            $manager->persist($billet);
            $manager->flush();

            //var_dump($billet);
            //var_dump($sessionBag->get('buyer'));
            //die;

            //$sessionBag->set('buyer', $buyer);

            return $this->redirectToRoute("order_step_3");
        }

        //var_dump($form->createView());
        //die;

        return $this->render('louvre/information.html.twig', [
            'formStep2' => $form->createView(),
            'nbVisitor' => $nbVisitor
        ]);
    }

    /**
     * @Route("/checkout", name="order_step_3")
     */
    public function checkout(Request $request, ObjectManager $manager)
    {   
        $sessionBag = $request->getSession();
        $buyer = $sessionBag->get('buyer');
        $billet = $sessionBag->get('billet');

        var_dump($buyer);
        die;


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
