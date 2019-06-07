<?php

namespace App\Validator\Constraints;

use App\Entity\Buyer;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;

class MaximumTicketsValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Constructeur MaximumTicketValidator.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function getTotalTickets(\DateTime $visitDay)
    {
        $result = $this->em->getRepository(Buyer::class)->findByVisitDay($visitDay);

        $total=[0];

        foreach ($result as $tickets)
        {
            $total[] = $tickets->getNbBillet();
        }
        $totalBilletDay = $this->total = array_sum($total);

        return $totalBilletDay;
    }

    public function validate($visitDay, Constraint $constraint)
    {
        $result = $this->getTotalTickets($visitDay->getVisitDay());

        if($result + $visitDay->getNbBillet() >= $constraint::MAXTICKETS)
        {
                $this->context->buildViolation($constraint->message)
                    ->atPath('visitDay')
                    ->addViolation();
        }
    }
}