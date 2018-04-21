<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use DigitalTavern\Infrastructure\Config\AppConfiguration;
use DigitalTavern\Ports\Command\WebsocketCommand;

try {
    $application = new Application('Yggdrasil CLI', '0.1');

    $appConfig = new AppConfiguration();
    $entityManager = $appConfig->loadDriver('entityManager');

    $helperSet = ConsoleRunner::createHelperSet($entityManager);
    $application->setHelperSet($helperSet);

    ConsoleRunner::addCommands($application);

    // register commands here
    $application->add(new WebsocketCommand($appConfig->loadDriver('container')));

    $application->run();
} catch (Exception $e) {
    echo 'Console error: '.$e->getMessage();
}