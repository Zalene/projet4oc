<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaximumTickets extends Constraint
{
    public $message = 'Plus de 1000 billets ont été vendu ce jour.';

    const MAXTICKETS = 1000;

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}