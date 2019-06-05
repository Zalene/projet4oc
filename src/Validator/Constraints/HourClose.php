<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HourClose extends Constraint
{
    public $message = 'Le musée est fermé après 19h';

    /**
     * @Const int
     */
    const HOURCLOSE = 19;

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
}