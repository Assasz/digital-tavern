<?php

namespace DigitalTavern\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class SignupRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule\Request
 */
class SignupRequest implements ServiceRequestInterface
{
    /**
     * User email address
     *
     * @var string
     */
    private $email;

    /**
     * User username
     *
     * @var string
     */
    private $username;

    /**
     * User password
     *
     * @var string
     */
    private $password;

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
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Returns user username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Sets user username
     *
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
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
}
