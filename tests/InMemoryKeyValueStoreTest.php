<?php

namespace Greeflas\Store\Tests;

use Greeflas\Store\InMemoryKeyValueStore;
use Greeflas\Store\KeyValueStoreInterface;
use PHPUnit\Framework\TestCase;

class InMemoryKeyValueStoreTest extends TestCase
{
    /**
     * @var InMemoryKeyValueStore
     */
    private $store;

    protected function setUp()
    {
        $this->store = new InMemoryKeyValueStore();
    }

    public function testInstanceOfKeyValueStoreInterface()
    {
        self::assertInstanceOf(KeyValueStoreInterface::class, $this->store);
    }

    public function testSet()
    {
        $this->store->set('test', "It's works!");

        self::assertTrue($this->store->has('test'), 'Store should have a value by key');
        self::assertFalse($this->store->has('undefined'));
    }

    public function testGet()
    {
        $expected = 'Learning PHPUnit framework!';
        $this->store->set('test', $expected);

        self::assertEquals($expected, $this->store->get('test'));
        self::assertNull($this->store->get('undefined'));
        self::assertEquals('not-set', $this->store->get('undefined', 'not-set'));
    }

    /**
     * @param string    $keyName
     * @param bool      $expected
     * @param bool      $toClear
     *
     * @dataProvider keysDataProvider
     */
    public function testHas(string $keyName, bool $expected, bool $toClear = false)
    {
        $this->store->set('first', 1);
        $this->store->set('second', 2);

        if ($toClear) {
            $this->store->clear();
        }

        self::assertEquals($this->store->has($keyName), $expected);
    }

    public function testRemove()
    {
        $this->store->set('test', [1, 2, 3, 4]);

        self::assertTrue($this->store->has('test'));

        $this->store->remove('test');

        self::assertFalse($this->store->has('test'));
    }

    public function testClear()
    {
        $this->store->set('first', 1.1);
        $this->store->set('second', 2.2);

        self::assertTrue($this->store->has('first'));
        self::assertTrue($this->store->has('second'));

        $this->store->clear();

        self::assertFalse($this->store->has('first'));
        self::assertFalse($this->store->has('second'));
    }

    public function testCound()
    {
        self::assertInstanceOf(\Countable::class, $this->store);
        self::assertCount(0, $this->store);

        $first = new \stdClass();
        $first->value = 1;
        $this->store->set('first', $first);

        $second = new \stdClass();
        $second->value = 2;
        $this->store->set('second', $second);

        self::assertCount(2, $this->store);
    }

    public function keysDataProvider(): iterable
    {
        yield [
            'first',
            true,
        ];

        // logic here...

        yield [
            'second',
            true,
        ];

        yield [
            'undefined',
            false,
        ];

        yield [
            'first',
            false,
            true,
        ];

        yield [
            'second',
            false,
            true,
        ];
    }
}
