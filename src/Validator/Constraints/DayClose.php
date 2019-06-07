<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DayClose extends Constraint
{
    public $message = 'Le musée est fermé le Mardi et le Dimanche.';
}