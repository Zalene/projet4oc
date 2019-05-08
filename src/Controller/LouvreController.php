<?php

namespace App\Controller;


use App\Entity\Buyer;

//use Symfony\Component\HttpFoundation\Response; //???
//use Symfony\Component\Validator\Validator\ValidatorInterface; //Pour la validation des champs de mes forms
//use Symfony\Component\Translation\TranslatorInterface; //Pour passer le site en Anglais

//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        //$buyer = $sessionBag->get('buyer', new Buyer());
        
        $buyer = new Buyer();
        //$buyer->setCreatedAt(new \DateTime());
        //$buyer->setVisitDay(new \DateTime('tomorrow'));

        $form = $this->createForm(BuyerType::class, $buyer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sessionBag->set('buyer', $buyer);

            //var_dump($sessionBag);
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
        
        //$buyer = new Billet();

        //$form = $this->createForm(BilletType::class, $buyer);

        $form = $this ->get('form.factory') ->create(CollectionType::class, $billet, ['entry_type' => BilletType::class]);

        //$form = $this->createForm(BilletType::class, $billet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($buyer);
            $manager->flush();

            //$buyer = $form->getCreatedAt();

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
