<?php

namespace Greeflas\Store;

class InMemoryKeyValueStore implements KeyValueStoreInterface
{
    private $storage = [];

    public function set($key, $value)
    {
        $this->storage[$key] = $value;
    }

    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            return $this->storage[$key];
        }

        return $default;
    }

    public function has($key)
    {
        return isset($this->storage[$key]);
    }

    public function remove($key)
    {
        if ($this->has($key)) {
            unset($this->storage[$key]);
        }
    }

    public function clear(): void
    {
        $this->storage = [];
    }
}
