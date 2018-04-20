<?php

namespace DigitalTavern\Application\Service\SessionModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class GetPlayersRequest
 * 
 * @package DigitalTavern\Application\Service\SessionModule\Request
 */
class GetPlayersRequest implements ServiceRequestInterface
{
    /**
     * Session channel
     * 
     * @var string $channel
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