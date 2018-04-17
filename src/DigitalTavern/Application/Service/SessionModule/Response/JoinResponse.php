<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use DigitalTavern\Domain\Entity\Session;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class JoinResponse
 *
 * @package DigitalTavern\Application\Service\SessionModule\Response
 */
class JoinResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * Requested session
     *
     * @var Session
     */
    private $session;

    /**
     * JoinResponse constructor.
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
     * Returns session
     *
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    /**
     * Sets session
     *
     * @param Session $session
     */
    public function setSession(Session $session): void
    {
        $this->session = $session;
    }
}