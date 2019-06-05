<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TypeClose extends Constraint
{
    public $message;

    /**
     * @Const int
     */
    const LIMITHOUR = 14;

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

}