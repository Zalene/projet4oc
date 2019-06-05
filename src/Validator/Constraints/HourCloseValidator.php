<?php

namespace App\Validator\Constraints;

use App\Entity\Buyer;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints\DateTime;

class HourCloseValidator extends ConstraintValidator
{    
    /**
     * @param DateTime $visitDay
     * @param Constraint $constraint
     */
    public function validate($visitDay, Constraint $constraint)
    {
        $date = date('d/m/Y');
        
        if($date == $visitDay->Format('d/m/Y'))
        {   
            $timezone  = +2; //(GMT +2:00) (France)
            $date = date('H', time() + 3600*($timezone+date("I")));

            if($date >= $constraint::HOURCLOSE)
            {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}