<?php

/*
 * This file is part of the "Key-Value store" library.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\Store;

use Greeflas\Store\Validation\KeyValidatorTrait;
use Greeflas\Store\Exception\InvalidConfigException;

abstract class AbstractFileKeyValueStore implements KeyValueStoreInterface
{
    use KeyValidatorTrait;

    protected $file;

    abstract protected function load();

    abstract protected function update(array $data);

    public function __construct(string $pathToFile)
    {
        if (empty($pathToFile)) {
            throw new InvalidConfigException('You should specify path to file');
        }

        if ('/' === \substr($pathToFile, -1, 1)) {
            throw new InvalidConfigException('You should specify path to file, path to directory given');
        }

        if (!\file_exists($pathToFile)) {
            throw new InvalidConfigException('File does not exist, you should create it');
        }

        $this->file = $pathToFile;
    }

    public function set($key, $value)
    {
        $this->validateKey($key);

        $data = $this->load();
        $data[$key] = \is_object($value) ? \serialize($value) : $value;
        $this->update($data);
    }

    public function get($key, $default = null)
    {
        $this->validateKey($key);

        $data = $this->load();

        if (isset($data[$key])) {
            $value = $data[$key];

            if (\is_string($value) && $object = @\unserialize($value)) {
                return $object;
            }

            return $value;
        }

        return $default;
    }

    public function has($key)
    {
        $this->validateKey($key);

        $data = $this->load();

        return isset($data[$key]);
    }

    public function remove($key)
    {
        $this->validateKey($key);

        $data = $this->load();

        if (isset($data[$key])) {
            unset($data[$key]);
            $this->update($data);
        }
    }

    public function clear()
    {
        \file_put_contents($this->file, '', \LOCK_EX);
    }
}
