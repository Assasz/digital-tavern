<?php

namespace DigitalTavern\Infrastructure\Driver;

use Yggdrasil\Component\TwigComponent\RoutingExtension;
use Yggdrasil\Component\TwigComponent\StandardExtension;
use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Yggdrasil\Core\Driver\Base\DriverInterface;
use Yggdrasil\Core\Exception\MissingConfigurationException;

/**
 * Class TemplateEngineDriver
 *
 * Custom template engine driver
 *
 * @package DigitalTavern\Infrastructure\Driver
 */
class TemplateEngineDriver implements DriverInterface
{
    /**
     * Instance of template engine
     *
     * @var \Twig_Environment
     */
    private static $engineInstance;

    /**
     * TemplateEngineDriver constructor.
     *
     * Should be private to prevent object creation. Same with __clone
     */
    private function __construct() {}

    private function __clone() {}

    /**
     * Returns instance of template engine
     *
     * @param ConfigurationInterface $appConfiguration Configuration needed to configure template engine
     * @return \Twig_Environment
     *
     * @throws MissingConfigurationException if view path is not configured
     */
    public static function getInstance(ConfigurationInterface $appConfiguration): \Twig_Environment
    {
        if(self::$engineInstance === null) {
            $configuration = $appConfiguration->getConfiguration();

            if(!$appConfiguration->isConfigured(['view_path', 'application_name'], 'application')){
                throw new MissingConfigurationException('There are missing parameters in your configuration. view_path and application_name is required for template engine to render views properly.');
            }

            $loader = new \Twig_Loader_Filesystem(dirname(__DIR__, 4) . '/src/'.$configuration['application']['view_path']);
            $twig = new \Twig_Environment($loader);

            $twig->addExtension(new StandardExtension());
            $twig->addExtension(new RoutingExtension($appConfiguration->loadDriver('router')));
            $twig->addExtension(new \Twig_Extensions_Extension_Date());

            $twig->addGlobal('_appname', $configuration['application']['application_name']);

            self::$engineInstance = $twig;
        }

        return self::$engineInstance;
    }
}