<?php

namespace App\Validator\Constraints;

use App\Entity\Buyer;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DayOffValidator extends ConstraintValidator
{    
    /**
     * @param DateTime $visitDay
     * @param Constraint $constraint
     */
    public function validate($visitDay, Constraint $constraint)
    {
        if (in_array($visitDay->Format('d/m'), $constraint->dayoff, true))
        {
            $this->context->buildViolation($constraint->message)
                          ->addViolation();
        }
    }
}