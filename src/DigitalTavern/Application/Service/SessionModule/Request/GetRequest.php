<?php

namespace DigitalTavern\Application\Service\SessionModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class GetRequest
 *
 * @package DigitalTavern\Application\Service\SessionModule\Request
 */
class GetRequest implements ServiceRequestInterface
{
    /**
     * Session channel
     *
     * @var string
     */
    private $channel;

    /**
     * Returns session channel
     *
     * @return string
     */
    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * Sets session channel
     *
     * @param string $channel
     */
    public function setChannel(string $channel): void
    {
        $this->channel = $channel;
    }
}