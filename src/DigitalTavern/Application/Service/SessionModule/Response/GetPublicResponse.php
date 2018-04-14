<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

class GetPublicResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * Public sessions
     *
     * @var array
     */
    private $sessions;

    /**
     * GetPublicResponse constructor.
     *
     * Sets default values
     */
    public function __construct()
    {
        $this->success = false;
        $this->sessions = [];
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
     * Returns public sessions
     *
     * @return array
     */
    public function getSessions(): array
    {
        return $this->sessions;
    }

    /**
     * Sets public sessions
     *
     * @param array $sessions
     */
    public function setSessions(array $sessions): void
    {
        $this->sessions = $sessions;
    }
}