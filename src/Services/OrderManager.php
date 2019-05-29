<?php

namespace App\Services;

use Exception;
use App\Entity\Buyer;
use App\Entity\Billet;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderManager {
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * OrderManager constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
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