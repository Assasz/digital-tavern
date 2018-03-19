<?php

namespace DigitalTavern\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class UserAuthRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule\Request
 *
 */
class UserAuthRequest implements ServiceRequestInterface
{
    /**
     * User email address
     *
     * @var string
     */
    private $email;

    /**
     * User password
     *
     * @var string
     */
    private $password;

    /**
     * "Remember me" flag
     *
     * @var bool
     */
    private $remember;

    /**
     * Returns user email address
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets user email address
     *
     * @param string $email
     */
    public  function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Returns user password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets user password
     *
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Indicates if user checked "remember me"
     *
     * @return bool
     */
    public function getRemember(): bool
    {
        return $this->remember;
    }

    /**
     * Sets "remember me" flag
     *
     * @param bool $remember
     */
    public function setRemember(bool $remember): void
    {
        $this->remember = $remember;
    }
}
