<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Xamin123\LearnBlockchain\UI\Console\AppCommand;

require __DIR__ . '/vendor/autoload.php';
$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('config/services.yaml');
$containerBuilder->compile();

$app = new Application();

/** @var AppCommand $appCommand */
$appCommand = $containerBuilder->get(AppCommand::class);


$app->add($appCommand);

try {
    $app->run();
} catch (Exception $e) {
}