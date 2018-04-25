<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use DigitalTavern\Domain\Entity\Session;
use DigitalTavern\Domain\Entity\User;
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
     * @var bool $success
     */
    private $success;

    /**
     * Requested session
     *
     * @var Session $session
     */
    private $session;

    /**
     * Updated instance of user
     *
     * @var User $user
     */
    private $user;

    /**
     * Error message
     *
     * @var null|string
     */
    private $error;

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

    /**
     * Returns updated user
     *
     * @return null|User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets updated user
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * Returns error message
     *
     * @return null|string
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Sets error message
     *
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }
}