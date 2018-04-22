<?php

namespace DigitalTavern\Infrastructure\Driver;

use Yggdrasil\Core\Configuration\ConfigurationInterface;
use Yggdrasil\Core\Driver\Base\DriverInterface;
use Hoa\Eventsource\Server;

/**
 * Class EventSourceDriver
 *
 * @package DigitalTavern\Infrastructure\Driver
 */
class EventSourceDriver implements DriverInterface
{
    /**
     * Event source instance
     *
     * @var Server
     */
    private static $sourceInstance;

    /**
     * EventSourceDriver constructor.
     *
     * Should be private to prevent object creation. Same with __clone
     */
    private function __construct() {}

    private function __clone() {}

    /**
     * Returns event source instance
     *
     * @param ConfigurationInterface $appConfiguration
     * @return Server
     *
     * @throws \Hoa\Eventsource\Exception
     */
    public static function getInstance(ConfigurationInterface $appConfiguration): Server
    {
        if(self::$sourceInstance === null){
            $server = new Server(false);
            self::$sourceInstance = $server;
        }

        return self::$sourceInstance;
    }
}