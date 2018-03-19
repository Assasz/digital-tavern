<?php

namespace DigitalTavern\Application\Service\UserModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;
use DigitalTavern\Domain\Entity\User;

/**
 * Class RememberedAuthResponse
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule\Response
 */
class RememberedAuthResponse implements ServiceResponseInterface
{
    /**
     * Result of service processing
     *
     * @var bool
     */
    private $success;

    /**
     * Authenticated user instance
     *
     * @var User
     */
    private $user;

    /**
     * RememberedAuthResponse constructor.
     *
     * Sets home value of $success
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
     * Returns authenticated user instance
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Sets authenticated user instance
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}