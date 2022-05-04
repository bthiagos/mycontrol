<?php
require_once 'vendor/autoload.php';

use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;

$loop = React\EventLoop\Loop::get();

echo 'inicio<br>';
$loop->addTimer(0.8, function () {
    echo 'meio!<br>' . PHP_EOL;
});

$loop->addTimer(0.3, function () {
    echo 'fim <br>';
});


$loop->run();