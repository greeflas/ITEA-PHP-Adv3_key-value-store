<?php

namespace Greeflas\Store\Tests;

use Greeflas\Store\Exception\InvalidConfigException;
use Greeflas\Store\YamlKeyValueStore;
use PHPUnit\Framework\TestCase;

final class YamlKeyValueStoreTest extends TestCase
{
    public function testPathNotSpecifiedException()
    {
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('You should specify path to file');

        new YamlKeyValueStore('');
    }

    /**
     * @expectedException \Greeflas\Store\Exception\InvalidConfigException
     * @expectedExceptionMessage You should specify path to file, path to directory given
     */
    public function testExpectedPathToFileException()
    {
        new YamlKeyValueStore('/path/to/file/');
    }

    public function testFileDoesNotExistsException()
    {
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('File does not exist, you should create it');

        new YamlKeyValueStore('/path/to/file.yaml');
    }
}
