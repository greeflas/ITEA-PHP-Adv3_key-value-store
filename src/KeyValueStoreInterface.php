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

/**
 * Interface of key value store component.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
interface KeyValueStoreInterface
{
    /**
     * Stores value by key.
     *
     * Example of using:
     * $store->set('defaultEmail', 'admin@example.com');
     *
     * @param string  $key   Name of the key.
     * @param mixed   $value Value to store.
     */
    public function set(string $key, $value): void;

    /**
     * Gets value by key.
     *
     * @param string     $key     Name of the key.
     * @param null|mixed $default Default value.
     *
     * @return mixed Can be of any type: int, string, null, array, e.g.
     * If value does not exist for provided key, $default will be returned.
     */
    public function get(string $key, $default = null);

    /**
     * Checks whether value is exist by key.
     *
     * @param string $key Name of key.
     *
     * @return bool Returns true if key exists, false otherwise.
     */
    public function has(string $key): bool;

    /**
     * Removes value by key.
     *
     * @param string $key Name of key.
     */
    public function remove(string $key): void;

    /**
     * Removes all keys and their values from the storage.
     */
    public function clear(): void;
}
