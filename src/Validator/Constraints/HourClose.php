<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HourClose extends Constraint
{
    public $message = 'Le musée est fermé après 19h.';

    const HOURCLOSE = 19;
}