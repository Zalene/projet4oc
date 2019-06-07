<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TypeClose extends Constraint
{
    public $message = 'Vous ne pouvez plus réserver de billet journée après 14h.';

    const LIMITHOUR = 14;

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}