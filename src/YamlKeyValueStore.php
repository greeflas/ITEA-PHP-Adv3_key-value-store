<?php

namespace Greeflas\Store;

use Symfony\Component\Yaml\Yaml;

class YamlKeyValueStore extends AbstractFileKeyValueStore
{
    protected function load()
    {
        $data = Yaml::parseFile($this->file);

        return \is_array($data) ? $data : [];
    }

    protected function update(array $data)
    {
        $yaml = Yaml::dump($data);
        \file_put_contents($this->file, $yaml, \LOCK_EX);
    }
}
