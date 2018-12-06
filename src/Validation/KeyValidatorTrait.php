<?php

/*
 * This file is part of the "Key-Value store" library.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
