<?php

namespace App\Validator\Constraints;

use App\Entity\Buyer;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints\DateTime;

class TypeCloseValidator extends ConstraintValidator
{    
    /**
     * @param Buyer $typeBillet
     * @param Constraint $constraint
     */
    public function validate($typeBillet, Constraint $constraint)
    {
        $date = date('d/m/Y');
    
        $timezone  = +2; //(GMT +2:00) (France)
        $date = date('H', time() + 3600*($timezone+date("I")));

        //dump($typeBillet);
        //die;
        
        if($date >= $constraint::LIMITHOUR && $typeBillet == 1)
        {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}