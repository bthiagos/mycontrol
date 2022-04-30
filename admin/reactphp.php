<?php


require './vendor/autoload.php';

$loop = ReactEventLoopFactory::create();

$loop->addPeriodicTimer(1, static function () {
    static $count;

    if (null === $count) {
        $count = 0;
    }

    echo $count++ . PHP_EOL;
});

$loop->run();

// Output:

// 0
// 1
// 2
// 3
// 4
// 5
// ...