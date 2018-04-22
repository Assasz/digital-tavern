<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use DigitalTavern\Infrastructure\Config\AppConfiguration;
use DigitalTavern\Infrastructure\Config\WsAppConfiguration;
use DigitalTavern\Ports\Command\WebsocketCommand;

try {
    $application = new Application('Yggdrasil CLI', '0.1');
    $appConfig = new AppConfiguration();

    $helperSet = ConsoleRunner::createHelperSet($appConfig->loadDriver('entityManager'));
    $application->setHelperSet($helperSet);

    ConsoleRunner::addCommands($application);

    $wsConfig = new WsAppConfiguration();

    // register commands here
    $application->add(new WebsocketCommand($wsConfig->loadDriver('container')));

    $application->run();
} catch (Exception $e) {
    echo 'Console error: '.$e->getMessage();
}