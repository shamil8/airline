<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsValidSeat extends Constraint
{
    public $message = 'Число {{ value }} не корректная!';

    public $anonymousMessage = 'Место - обычное число от 1 до 150!';
}