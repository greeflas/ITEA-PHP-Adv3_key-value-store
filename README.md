Key Value Store
===============

[![Key Value Store](https://img.shields.io/badge/PHP%20Advanced-ITEA-red.svg)](#key-value-store)

This is simple implementation of Key-Value Store. Library provides implementation of
in memory storage, Json file store and Yaml file store.

Usage
-----

1. Create storage instance

```php
$store = new \Greeflas\Store\InMemoryKeyValueStore();
```

2. Manipulate with data

```php
$store->set('db_name', 'app_prod');

$databaseName = $store->get('db_name') ?? 'app_dev';

if ($store->has('db_name')) {
    $store->remove('db_name');
}

$store->clear();
```

Tests
-----

You can run tests for each storage implementation with following command

`$ ./bin/tests <store-type>`

available types:

- `in-memory`
- `json`
- `yaml`

example

`$ ./bin/tests json`
