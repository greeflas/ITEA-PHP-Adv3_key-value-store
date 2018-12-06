<?php

$header = <<<HEADER
This file is part of the "Key-Value store" library.

(c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
HEADER;

$finder = \PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src/')
;

return \PhpCsFixer\Config::create()
    ->setCacheFile(__DIR__ . '/.php_cs.cache')
    ->setRules([
        '@PSR2' => true,
        'header_comment' => [
            'header' => $header,
            'commentType' => 'comment',
            'separate' => 'both',
        ],
    ])
    ->setFinder($finder)
;
