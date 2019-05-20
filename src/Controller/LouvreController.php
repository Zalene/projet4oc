<?php

namespace App\Controller;


use App\Entity\Buyer;
use App\Entity\Billet;

use App\Form\BuyerType;
use App\Form\BilletType;

use App\Services\OrderManager;
use App\Services\MailerManager;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LouvreController extends AbstractController
{

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="accueil")
     */
    public function home()
    {   
        $directory = getcwd();
        return $this->render('louvre/home.html.twig', [
            'controller_name' => 'AccueilController',
            'directory' => $directory
        ]);
    }

    /**
     * @Route("/order", name="order_step_1")
     */
    public function order(Request $request)
    {        
        $buyer = new Buyer();

        $form = $this->createForm(BuyerType::class, $buyer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->session->set('buyer', $buyer);

            return $this->redirectToRoute("order_step_2");
        }

        return $this->render('louvre/order.html.twig', [
            'formStep1' => $form->createView()
        ]);
    }

    /**
     * @Route("/information", name="order_step_2")
     */
    public function information(Request $request, OrderManager $orderManager)
    {   
        $buyer = $this->session->get('buyer');

        //$nbBillet = $buyer->getNbBillet('nbBillet');

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

            $this->session->set('buyer', $buyer);
            $this->session->set('billet', $billet);

            return $this->redirectToRoute("order_step_3");
        }

        return $this->render('louvre/information.html.twig', [
            'formStep2' => $form->createView(),
            'nbVisitor' => $nbVisitor,
            'buyer' => $buyer
        ]);
    }

    /**
     * @Route("/checkout", name="order_step_3")
     */
    public function checkout(Request $request, ObjectManager $manager, OrderManager $orderManager, MailerManager $mailerManager)
    {   
        $buyer = $this->session->get('buyer');
        $billet = $this->session->get('billet');

        $form = $this->createForm(BuyerType::class, $buyer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($buyer);

            foreach ($billet as $visitor) {
                $manager->persist($visitor);
            }

            $manager->flush();

            return $this->redirectToRoute("order_step_4");
        }

        return $this->render('louvre/checkout.html.twig', [
            'formStep3' => $form->createView(),
            'buyer' => $buyer,
            'billet' => $billet
        ]);
    }

    /**
     * @Route("/confirmation", name="order_step_4")
     */
    public function confirmation()
    {   
        return $this->render('louvre/confirmation.html.twig', [
            'buyer' => $buyer,
            'billet' => $billet
        ]);
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentionsLegales()
    {   
        return $this->render('louvre/mentions.html.twig');
    }

}
