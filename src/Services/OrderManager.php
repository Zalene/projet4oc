<?php

namespace App\Services;

use Exception;


use App\Entity\Buyer;
use App\Entity\Billet;

use Doctrine\DBAL\DBALException;
//use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
//use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class OrderManager {
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var FlashBagInterface
     */
    private $flashbag;

    /**
     * @var EntityManagerInterface)
     */
    private $em;

    /**
     * @var UrlGeneratorInterface
     */
    private $route;

    /**
     * @var string $stripekey
     */
    private $stripekey;

    /**
     * OrderManager constructor.
     * @param SessionInterface $session
     * @param FlashBagInterface $flashBag
     * @param UrlGeneratorInterface $route
     * @param EntityManagerInterface $em
     * @param $stripekey
     */
    public function __construct(SessionInterface $session)/*, FlashBagInterface $flashBag, UrlGeneratorInterface $route , EntityManagerInterface $em , $stripekey */
    {
        $this->session = $session;
        //$this->stripekey = $stripekey;
        //$this->flashbag = $flashBag;
        //$this->em = $em;
        //$this->route = $route;
    }

    /**
     * @param Billet $billet
     */
    public function setPriceBillets(array $billets, Buyer $buyer)
    {
        foreach ($billets as $billet)
        {
            // Réduction
            if($billet->isReduced())
            {
                $price = Billet::REDUCED_PRICE;
            } else {
                $price = $this->getPriceRange($billet->getAge($buyer->getVisitDay()));
            }
            // Demi Journée
            if(!$buyer->getTypeBillet())
            {
                $price = $price / 2;
            }
            /** @var int $price */
            $billet->setPrice($price);
            $billet->setBuyer($buyer);
        }
    }

    /**
     * @param $billet
     * @return int
     */
    public function getPriceRange(int $billet) : int
    {
        switch ($billet) {
            case $billet > 0 && $billet <= 4 :
                $price = 0;
                break;
            case $billet > 4 && $billet <= 12:
                $price = 8;
                break;
            case $billet >= 60:
                $price = 12;
                break;
            default:
                $price = 16;
                break;
        }
        return $price;
    }

    /**
     * @param Buyer $buyer
     * @return mixed
     */
    public function setSessionBuyer(Buyer $buyer)
    {
        return $this->session->set('buyer', $buyer);
    }
    
    /**
     * @param string $session
     * @return mixed
     */
    public function getSessionBuyer(string $session)
    {
        return $this->session->get($session);
    }

    /**
     * @param Billet $billet
     * @return mixed
     */
    public function setSessionBillet(array $billet)
    {
        foreach ($billet as $visitor) {
            $this->session->set('billet', $visitor);
        }
    }

    /**
     * @param string $session
     * @return mixed
     */
    public function getSessionBillet(string $session)
    {
        return $this->session->get($session);
    }

    /**
     * @param $buyer
     */
    public function buyerNotFound($buyer)
    {
        if(!$buyer)
        {
            throw new NotFoundHttpException('Désolé mais vous n\'êtes pas autorisé à accéder à cette page');
        }
    }
}