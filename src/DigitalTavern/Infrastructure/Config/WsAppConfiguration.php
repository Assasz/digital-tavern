<?php

namespace DigitalTavern\Infrastructure\Config;

use Yggdrasil\Core\Configuration\AbstractConfiguration;
use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Yggdrasil\Core\Driver\ContainerDriver;
use Yggdrasil\Core\Driver\EntityManagerDriver;
use Yggdrasil\Core\Driver\ExceptionHandlerDriver;
use Yggdrasil\Core\Driver\MailerDriver;
use Yggdrasil\Core\Driver\RouterDriver;
use DigitalTavern\Infrastructure\Driver\TemplateEngineDriver;
use Yggdrasil\Core\Driver\ValidatorDriver;

/**
 * Class WsAppConfiguration
 *
 * Manages configuration of WebSockets application
 *
 * @package DigitalTavern\Infrastructure\Config
 */
class WsAppConfiguration extends AbstractConfiguration implements ConfigurationInterface
{
    /**
     * AppConfiguration constructor.
     *
     * Register drivers here
     */
    public function __construct()
    {
        // Config directory of application
        parent::__construct('DigitalTavern/Infrastructure/Config');

        $this->drivers = [
            'router' => RouterDriver::class,
            'entityManager' => EntityManagerDriver::class,
            'templateEngine' => TemplateEngineDriver::class,
            'container' => ContainerDriver::class,
            'validator' => ValidatorDriver::class,
            'mailer' => MailerDriver::class
        ];
    }
}