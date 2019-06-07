<?php

namespace App\Validator\Constraints;

use App\Entity\Buyer;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DayCloseValidator extends ConstraintValidator
{    
    public function validate($visitDay, Constraint $constraint)
    {
        if (in_array($visitDay->Format('D'),['Mon', 'Sat'], true))
        {
            $this->context->buildViolation($constraint->message)
                          ->addViolation();
        }
    }
}