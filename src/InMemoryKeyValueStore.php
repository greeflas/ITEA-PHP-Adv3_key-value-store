<?php

namespace Greeflas\Store;

use Greeflas\Store\Validation\KeyValidatorTrait;

class InMemoryKeyValueStore implements KeyValueStoreInterface
{
    use KeyValidatorTrait;

    private $storage = [];

    public function set($key, $value)
    {
        $this->validateKey($key);

        $this->storage[$key] = $value;
    }

    public function get($key, $default = null)
    {
        $this->validateKey($key);

        if ($this->has($key)) {
            return $this->storage[$key];
        }

        return $default;
    }

    public function has($key)
    {
        $this->validateKey($key);

        return isset($this->storage[$key]);
    }

    public function remove($key)
    {
        $this->validateKey($key);

        if ($this->has($key)) {
            unset($this->storage[$key]);
        }
    }

    public function clear(): void
    {
        $this->storage = [];
    }
}
