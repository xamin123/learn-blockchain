<?php

use Symfony\Component\Console\Application;
use Xamin123\LearnBlockchain\UI\Console\AppCommand;

require __DIR__ . '/vendor/autoload.php';

$app = new Application();
$app->add(
    new AppCommand('blockchain_test')
);
try {
    $app->run();
} catch (Exception $e) {
}