<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DayOff extends Constraint
{
    public $message = 'Réservation impossible lors des jours fériés.';

    public $dayoff = ['01/01', '22/04', '01/05', '08/05', '30/05', '10/06', '14/07', '15/08', '01/11', '11/11', '25/12'];

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
}