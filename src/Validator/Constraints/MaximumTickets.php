<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaximumTickets extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Plus de 1000 billets ont été vendu ce jour.';

    /**
     * @const int
     */
    const MAXTICKETS = 1000;
    
    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}