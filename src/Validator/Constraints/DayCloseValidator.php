<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DayCloseValidator extends ConstraintValidator
{
    /**
     * Si la dateest un mardi ou un dimanche
     * @param mixed $visitDay
     * @param Constraint $constraint
     */
    public function validate($visitDay, Constraint $constraint)
    {
        /* @var DayClose $constraint  */
        if(in_array($visitDay->format('D'),['Tue', 'Sun'], true))
        {
            $this->context->buildViolation($constraint->message)
                          ->addViolation();
        }
    }
}