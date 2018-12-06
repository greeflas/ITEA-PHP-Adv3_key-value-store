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

class InMemoryKeyValueStore implements KeyValueStoreInterface, \Countable
{
    private $storage = [];

    public function set(string $key, $value): void
    {
        $this->storage[$key] = $value;
    }

    public function get(string $key, $default = null)
    {
        return $this->storage[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return isset($this->storage[$key]);
    }

    public function remove(string $key): void
    {
        if ($this->has($key)) {
            unset($this->storage[$key]);
        }
    }

    public function clear(): void
    {
        $this->storage = [];
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return \count($this->storage);
    }
}
