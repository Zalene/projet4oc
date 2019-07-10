<?php

namespace App\Validator\Constraints;

use App\Entity\Buyer;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TypeCloseValidator extends ConstraintValidator
{   
    public function validate($value, Constraint $constraint)
    {
        $date = date('d/m/Y');
        
        if($date == $value->getVisitDay()->Format('d/m/Y'))
        {   
            $timezone  = +2; //(GMT +2:00) (France)
            $date = date('H', time() + 3600*($timezone+date("I")));

            if($date >= $constraint::LIMITHOUR && $value->getTypeBillet() == 1)
            {
                $this->context->buildViolation($constraint->message)
                    ->atPath('typeBillet')
                    ->addViolation();
            }
        }
    }
}
    
    