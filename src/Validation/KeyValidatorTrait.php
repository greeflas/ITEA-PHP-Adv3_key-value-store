<?php

namespace Greeflas\Store\Validation;

use Greeflas\Store\Exception\KeyValidationException;

trait KeyValidatorTrait
{
    protected function validateKey($key)
    {
        if (!\is_string($key) && !\is_int($key)) {
            throw new KeyValidationException(
                \sprintf('Key of type %s not supported by this storage', \gettype($key))
            );
        }
    }
}
