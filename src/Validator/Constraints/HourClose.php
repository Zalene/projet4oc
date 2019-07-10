<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HourClose extends Constraint
{
    public $message = 'Le musée est fermé après 18h.';

    const HOURCLOSE = 18;
}