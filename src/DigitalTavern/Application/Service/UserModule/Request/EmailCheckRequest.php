<?php

namespace DigitalTavern\Application\Service\UserModule\Request;

use Yggdrasil\Core\Service\ServiceRequestInterface;

/**
 * Class EmailCheckRequest
 *
 * This is a part of built-in user module, feel free to customize as needed
 *
 * @package DigitalTavern\Application\Service\UserModule\Request
 */
class EmailCheckRequest implements ServiceRequestInterface
{
    /**
     * User email address
     *
     * @var string
     */
    private $email;

    /**
     * Returns email address
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets email address
     *
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}