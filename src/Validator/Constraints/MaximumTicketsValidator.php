<?php
namespace App\Validator\Constraints;

use App\Entity\Buyer;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaximumTicketsValidator extends ConstraintValidator
{
    /**
     * Si la date choisie est égale à une date spécifique
     * @param Buyer $buyer
     * @param Constraint $constraint
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function validate($buyer, Constraint $constraint)
    {
        /* @var MaximumTickets $constraint  */
        $result = $this->getTotalTickets($buyer->getVisitDay());
        if($result + $buyer->getNbBillet() >= $constraint::MAXTICKETS)
        {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
        }
    }

    /**
     * @param \DateTime $visitDay
     * @param Buyer $buyer
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function getTotalTickets($buyer, \DateTime $visitDay)
    {
        $total=[0];

        foreach ($buyer as $tickets)
        {
            $total[] = $tickets->getNbBillet();
        }
        $this->total = array_sum($total);

        dump($total);
        die;
        
        return $this;
    }
}