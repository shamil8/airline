<?php


namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use \InvalidArgumentException;

class IsValidSeatValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if ($value > 150 || $value < 1) {
            $this->context->buildViolation($constraint->message)->addViolation();

            throw new InvalidArgumentException($constraint->anonymousMessage);
        }
    }
}