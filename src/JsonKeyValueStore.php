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

class JsonKeyValueStore extends AbstractFileKeyValueStore
{
    protected function load()
    {
        $storage = \file_get_contents($this->file);
        $data = \json_decode($storage, true);

        return \is_array($data) ? $data : [];
    }

    protected function update(array $data)
    {
        $json = \json_encode($data, \JSON_PRETTY_PRINT);
        \file_put_contents($this->file, $json, \LOCK_EX);
    }
}
