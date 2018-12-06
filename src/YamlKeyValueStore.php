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

use Symfony\Component\Yaml\Yaml;

class YamlKeyValueStore extends AbstractFileKeyValueStore
{
    protected function load(): array
    {
        $data = Yaml::parseFile($this->file);

        return \is_array($data) ? $data : [];
    }

    protected function update(array $data): void
    {
        $yaml = Yaml::dump($data);
        \file_put_contents($this->file, $yaml, \LOCK_EX);
    }
}
