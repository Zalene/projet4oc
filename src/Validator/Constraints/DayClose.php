<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DayClose extends Constraint
{
    public $message = 'Aucune réservation possible le Mardi et le Dimanche.';
}