<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

class CreateResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool $success
     */
    private $success;

    /**
     * Session WebSocket channel
     *
     * @var string
     */
    private $channel;

    /**
     * CreateResponse constructor.
     *
     * Sets $success default value
     */
    public function __construct()
    {
        $this->success = false;
    }

    /**
     * Returns result of service processing
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Sets result of service processing
     *
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

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