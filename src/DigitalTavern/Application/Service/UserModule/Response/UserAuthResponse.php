<?php

namespace DigitalTavern\Application\Service\UserModule\Response;

use DigitalTavern\Domain\Entity\User;
use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class UserAuthResponse
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule\Response
 */
class UserAuthResponse implements ServiceResponseInterface
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
     * Remember me token in plain text
     *
     * @var string
     */
    private $rememberToken;

    /**
     * User enabled status
     *
     * @var bool
     */
    private $enabled;

    /**
     * UserAuthResponse constructor.
     *
     * Sets home values
     */
    public function __construct()
    {
        $this->success = false;
        $this->enabled = true;
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

    /**
     * Returns remember me token
     *
     * @return string
     */
    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }

    /**
     * Sets remember me token
     *
     * @param string $rememberToken
     */
    public function setRememberToken(string $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }

    /**
     * Returns user enabled status
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Sets user enabled status
     *
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }
}