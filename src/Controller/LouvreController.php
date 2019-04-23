<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LouvreController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {   
        $directory = getcwd();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'directory'=>$directory
        ]);
    }
}
